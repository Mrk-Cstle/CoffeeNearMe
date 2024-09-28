<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);
$action = isset($data['action']) ? $data['action'] : '';


function sanitizeInput($data)
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

try {
    if ($action === "reload") {


        include '../include/dbConnection.php';

        $category = sanitizeInput($data['categoryFilter']);
        $searchQuery = sanitizeInput($data['searchQuery']);
        $page  = sanitizeInput($data['page']);
        $itemsPerPage = sanitizeInput($data['itemsPerPage']);

        // Calculate the offset for the query
        $offset = ($page - 1) * $itemsPerPage;

        $sql = "SELECT * FROM ingredients WHERE 1=1";
        if (!empty($category)) {
            $sql .= " AND category = '$category'";
        }
        if (!empty($searchQuery)) {
            $sql .= " AND raw_name LIKE '%$searchQuery%'";
        }




        $result = $conn->query($sql);
        $totalItems = $result->num_rows;

        $sql .= " LIMIT $offset, $itemsPerPage";
        $result = $conn->query($sql);

        if (!$result) {
            die(json_encode(["status" => "error", "message" => "Invalid query: " . $conn->error]));
        }

        // Read data for each row
        $ingredients = [];

        while ($row = $result->fetch_assoc()) {
            $ingredients[] = $row;
        }
        $conn->close();

        $totalPages = ceil($totalItems / $itemsPerPage);

        echo json_encode([
            "status" => "success",
            "message" => 'success',
            "ingredients" => $ingredients,
            "totalPages" => $totalPages
        ]);
    } elseif ($action === 'delete') {

        $ingredients_id = sanitizeInput($data['ingredients_id']);

        include '../include/dbConnection.php';

        // Start the transaction
        $conn->begin_transaction();

        try {
            // Fetch the ingredient's picture before deletion
            $sql = "SELECT raw_name, picture FROM ingredients WHERE ingredients_id = ?";
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                throw new Exception("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            }
            $stmt->bind_param('i', $ingredients_id);
            $stmt->execute();
            $stmt->bind_result($ingredient_name, $fileName);
            $stmt->fetch();
            $stmt->close();

            // If a picture exists, delete the file
            if ($fileName) {
                // Construct the full path to the image file
                $uploadDir = '../uploads/ingredients/';
                $filePath = $uploadDir . $fileName;

                // Check if the file exists and delete it
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Now delete the ingredient from the database
            $stmt = $conn->prepare("DELETE FROM ingredients WHERE ingredients_id = ?");
            if (!$stmt) {
                throw new Exception("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            }
            $stmt->bind_param("i", $ingredients_id);
            $stmt->execute();

            // Check if the deletion was successful
            if ($stmt->affected_rows > 0) {
                // Log the action in the inventory_actions table
                session_start();
                $action_type = "Delete Ingredient";
                $user = $_SESSION['full_name']; // Assuming session stores the user name


                $log_stmt = $conn->prepare("INSERT INTO inventory_action (action_type, item,  performed_by) VALUES ( ?, ?, ?)");
                if (!$log_stmt) {
                    throw new Exception("Prepare failed: (" . $conn->errno . ") " . $conn->error);
                }
                $log_stmt->bind_param("sss", $action_type, $ingredient_name,  $user);
                $log_stmt->execute();

                // Commit the transaction if both queries were successful
                $conn->commit();

                echo json_encode(["status" => "success", "message" => "Record deleted successfully"]);

                // Close the log statement
                $log_stmt->close();
            } else {
                throw new Exception("No record found to delete");
            }
        } catch (Exception $e) {
            // Rollback the transaction in case of any errors
            $conn->rollback();
            echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } elseif ($action === 'add') {



        session_start();

        include '../include/dbConnection.php';
        $ingredients = sanitizeInput($data['ingredients']);
        $category = sanitizeInput($data['category']);
        $qty = sanitizeInput($data['qty']);
        $ideal_qty = sanitizeInput($data['ideal_qty']);

        $action_type = "Add Ingredient";
        $user = $_SESSION['full_name']; // Assuming session stores user name

        // Start the transaction
        $conn->begin_transaction();

        try {
            // Insert into ingredients table
            $stmt = $conn->prepare("INSERT INTO ingredients (raw_name, category, quantity, ideal_quantity) VALUES (?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            }
            $stmt->bind_param("ssii", $ingredients, $category, $qty, $ideal_qty);
            $stmt->execute();

            // Get the last inserted ID of the new ingredient


            // Insert action log into the `inventory_actions` table
            $log_stmt = $conn->prepare("INSERT INTO inventory_action (action_type, item, quantity, performed_by) VALUES (?, ?, ?, ?)");
            if (!$log_stmt) {
                throw new Exception("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            }
            $log_stmt->bind_param("ssis", $action_type, $ingredients, $qty, $user);
            $log_stmt->execute();

            // If both queries were successful, commit the transaction
            $conn->commit();

            echo json_encode(["status" => "success", "message" => "New record created successfully"]);

            // Close the statements
            $log_stmt->close();
            $stmt->close();
        } catch (Exception $e) {
            // If there is an error, roll back the transaction
            $conn->rollback();
            echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }

        // Close the connection
        $conn->close();
    } elseif ($action === 'edit') {
        $ingredients_names = sanitizeInput($data['ingredients_names']);
        $ingredients_qtys = sanitizeInput($data['ingredients_qtys']);
        $ingredients_idealqtys = sanitizeInput($data['ingredients_idealqtys']);
        $ingredients_id = sanitizeInput($data['ingredients_id']);
        $ingredients_categorys = sanitizeInput($data['ingredients_categorys']);

        include '../include/dbConnection.php';

        // Fetch the current data for the ingredient
        $select_sql = "SELECT * FROM ingredients WHERE ingredients_id = ?";
        $select_stmt = $conn->prepare($select_sql);
        $select_stmt->bind_param("i", $ingredients_id);
        $select_stmt->execute();

        $result = $select_stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            // Extract existing data from the database
            $db_raw_name = $row['raw_name'];
            $db_qty = $row['quantity'];
            $db_ideal_qty = $row['ideal_quantity'];
            $db_categorys = $row['category'];

            // Check for changes in each field
            $noChanges = (
                $ingredients_names == $db_raw_name &&
                $ingredients_qtys == $db_qty &&
                $ingredients_idealqtys == $db_ideal_qty &&
                $ingredients_categorys == $db_categorys
            );

            if ($noChanges) {
                // No changes detected
                echo json_encode(["status" => "error", "message" => "No changes to update."]);
            } else {
                // Dynamically build the SQL query based on changes
                $updateFields = [];
                $updateValues = [];

                if ($ingredients_names != $db_raw_name) {
                    $updateFields[] = "raw_name = ?";
                    $updateValues[] = $ingredients_names;
                }
                if ($ingredients_qtys != $db_qty) {
                    $updateFields[] = "quantity = ?";
                    $updateValues[] = $ingredients_qtys;
                }
                if ($ingredients_idealqtys != $db_ideal_qty) {
                    $updateFields[] = "ideal_quantity = ?";
                    $updateValues[] = $ingredients_idealqtys;
                }
                if ($ingredients_categorys != $db_categorys) {
                    $updateFields[] = "category = ?";
                    $updateValues[] = $ingredients_categorys;
                }

                // Prepare the update query if there are changes
                if (!empty($updateFields)) {
                    $updateFields = implode(", ", $updateFields);
                    $updateValues[] = $ingredients_id; // Add ingredients_id for the WHERE clause

                    $sql = "UPDATE ingredients SET $updateFields WHERE ingredients_id = ?";
                    $stmt = $conn->prepare($sql);

                    // Bind the parameters dynamically
                    $types = str_repeat('s', count($updateValues) - 1) . 'i';  // 's' for strings, 'i' for ingredients_id (integer)
                    $stmt->bind_param($types, ...$updateValues);

                    try {
                        $stmt->execute();
                        echo json_encode([
                            "status" => "success",
                            "message" => "Record updated successfully"
                        ]);
                    } catch (Exception $e) {
                        echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
                    }

                    $stmt->close();
                }
            }
        }

        $conn->close();
    } elseif ($action === 'stockout') {
        $ingredientId = sanitizeInput($data['ingredientId']);
        $stockQty = sanitizeInput($data['stockQty']);
        $ingredientName = sanitizeInput($data['ingredientName']);

        session_start();

        $action_type = "Stock Out";
        $user = $_SESSION['full_name'];

        include '../include/dbConnection.php';
        $conn->begin_transaction();

        try {

            $quantity_stmt = $conn->prepare("SELECT quantity FROM ingredients WHERE ingredients_id = ?");
            $quantity_stmt->bind_param("i", $ingredientId);
            $quantity_stmt->execute();
            $quantity_stmt->bind_result($currentQuantity);
            $quantity_stmt->fetch();
            $quantity_stmt->close();


            if ($currentQuantity < $stockQty) {
                throw new Exception("Stock quantity is insufficient. Stock Available: " . $currentQuantity);
            }
            if ($stockQty <= 0) {
                throw new Exception("Please input a value higher than 0.");
            }



            $stmt = $conn->prepare("UPDATE ingredients SET quantity = quantity - ? WHERE ingredients_id = ?");
            $stmt->bind_param("ii", $stockQty, $ingredientId);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }


            $log_stmt = $conn->prepare("INSERT INTO inventory_action (action_type, item, quantity, performed_by) VALUES (?, ?, ?, ?)");
            $log_stmt->bind_param("ssis", $action_type, $ingredientName, $stockQty, $user);
            if (!$log_stmt->execute()) {
                throw new Exception("Execute failed for INSERT: (" . $log_stmt->errno . ") " . $log_stmt->error);
            }

            // Commit the transaction
            $conn->commit();

            echo json_encode(["status" => "success", "message" => "Stock out successfully"]);

            // Close the statements
            $log_stmt->close();
            $stmt->close();
        } catch (Exception $e) {
            // Rollback the transaction if any error occurs
            $conn->rollback();
            echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    } elseif ($action === 'stockin') {
        $ingredientId = sanitizeInput($data['ingredientId']);
        $stockQty = sanitizeInput($data['stockQty']);
        $ingredientName = sanitizeInput($data['ingredientName']);


        session_start();

        $action_type = "Stock In";
        $user = $_SESSION['full_name'];

        include '../include/dbConnection.php';
        $conn->begin_transaction();

        try {
            if ($stockQty <= 0) {
                throw new Exception("Please input a value higher than 0.");
            }
            $stmt = $conn->prepare("UPDATE ingredients SET  quantity = quantity + ? WHERE ingredients_id = ?");


            $stmt->bind_param("ii", $stockQty, $ingredientId);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }


            $log_stmt = $conn->prepare("INSERT INTO inventory_action (action_type, item, quantity, performed_by) VALUES (?, ?, ?, ?)");


            $log_stmt->bind_param("ssis", $action_type, $ingredientName, $stockQty, $user);
            if (!$log_stmt->execute()) {
                throw new Exception("Execute failed for INSERT: (" . $log_stmt->errno . ") " . $log_stmt->error);
            }

            // If both queries were successful, commit the transaction
            $conn->commit();

            echo json_encode(["status" => "success", "message" => "Stock in successfully"]);

            // Close the statements
            $log_stmt->close();
            $stmt->close();
        } catch (Exception $e) {
            $conn->rollback();
            echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
        }
    } else {
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
