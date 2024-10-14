<?php

require '../../vendor/autoload.php'; // Load Composer's autoloader

use UnitConverter\UnitConverter;

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

        // SQL to fetch products
        $sql = "SELECT * FROM product WHERE 1=1";

        if (!empty($category)) {
            $sql .= " AND product_category = '$category'";
        }
        if (!empty($searchQuery)) {
            $sql .= " AND product_name LIKE '%$searchQuery%'";
        }

        $result = $conn->query($sql);

        if (!$result) {
            die(json_encode(["status" => "error", "message" => "Invalid query: " . $conn->error]));
        }

        // Prepare the product data array
        $product = [];

        while ($row = $result->fetch_assoc()) {
            $productId = $row['product_id'];

            // Query to check ingredient availability for this product
            $ingredientsQuery = "
        SELECT pi.ingredients_id, pi.quantity AS required_quantity,pi.unit AS ingredient_unit, i.quantity AS available_stock, i.unit AS available_unit 
        FROM product_ingredients pi
        JOIN ingredients i ON pi.ingredients_id = i.ingredients_id
        WHERE pi.product_id = ?";

            $stmt = $conn->prepare($ingredientsQuery);
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $ingredientsResult = $stmt->get_result();

            $canMake = PHP_INT_MAX;  // Initialize to a large number to find the limiting factor

            $converter = UnitConverter::default();

            while ($ingredient = $ingredientsResult->fetch_assoc()) {
                $required = $ingredient['required_quantity'];
                $available = $ingredient['available_stock'];
                $ingredientUnit = $ingredient['ingredient_unit'];
                $availableUnit = $ingredient['available_unit'];

                $converted = $converter->convert($available, 10)->from($availableUnit)->to($ingredientUnit);

                // Calculate how many products can be made based on the limiting ingredient
                if ($converted < $required) {
                    $canMake = 0;  // Not enough stock to make even one product
                    break;
                } else {
                    $canMake = floor($converted / $required);
                }
            }

            // Add product details to the array, including available quantity
            $row['available_quantity'] = $canMake;
            $product[] = $row;
        }

        $conn->close();

        echo json_encode([
            "status" => "success",
            "message" => "success",
            "product" => $product
        ]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
