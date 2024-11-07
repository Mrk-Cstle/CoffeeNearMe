<?php
include '../include/dbConnection.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json'); // Set header to return JSON

function fetch_sales_data($conn)
{
    // Group sales by day
    $sql = "SELECT DATE(timestamp) as sale_date, SUM(total_amount) as total_sales 
            FROM transaction 
            GROUP BY DATE(timestamp)
            ORDER BY sale_date";

    $result = $conn->query($sql);

    $dates = [];
    $sales = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dates[] = $row['sale_date'];
            $sales[] = (int)$row['total_sales'];
        }
    } else {
        echo json_encode(['error' => 'No sales data found.']);
        exit;
    }

    return [$dates, $sales];
}

// Fetch data
list($dates, $sales) = fetch_sales_data($conn);

// ARIMA class definition
class ARIMA
{
    private $p; // AR order
    private $d; // Differencing order
    private $q; // MA order
    private $ar_coefficients = [];
    private $ma_coefficients = [];

    public function __construct($p, $d, $q)
    {
        $this->p = $p;
        $this->d = $d;
        $this->q = $q;
    }

    public function difference($data)
    {
        $diff_data = [];
        for ($i = $this->d; $i < count($data); $i++) {
            $diff_data[] = $data[$i] - $data[$i - $this->d];
        }
        return $diff_data;
    }

    public function autoregression($data)
    {
        $n = count($data);
        if ($n < $this->p) return []; // Not enough data for AR

        // Create a matrix of the lagged values
        $X = [];
        for ($i = $this->p; $i < $n; $i++) {
            $row = [];
            for ($j = 0; $j < $this->p; $j++) {
                $row[] = $data[$i - $j - 1];
            }
            $X[] = $row;
        }

        // Convert to a matrix for least squares estimation
        $Y = array_slice($data, $this->p);

        // Perform least squares regression to get AR coefficients
        $this->ar_coefficients = $this->leastSquares($X, $Y);
        return $this->ar_coefficients;
    }

    public function moving_average($errors)
    {
        $n = count($errors);
        if ($n < $this->q) return []; // Not enough data for MA

        // Create a matrix of the errors
        $X = [];
        for ($i = $this->q; $i < $n; $i++) {
            $row = array_slice($errors, $i - $this->q, $this->q);
            $X[] = $row;
        }

        // Convert errors to a response variable
        $Y = array_slice($errors, $this->q);

        // Perform least squares regression to get MA coefficients
        $this->ma_coefficients = $this->leastSquares($X, $Y);
        return $this->ma_coefficients;
    }

    public function fit($data)
    {
        $stationary_data = $this->difference($data);
        $this->autoregression($stationary_data);
        $this->moving_average($stationary_data);
        return true; // Fit completed
    }

    public function forecast($data, $steps = 1)
    {
        $this->fit($data);
        $last_value = end($data);
        $forecast = [];

        // Simulate forecasting using AR and MA coefficients
        for ($i = 0; $i < $steps; $i++) {
            $ar_part = 0;
            $ma_part = 0;

            // AR part
            for ($j = 0; $j < $this->p; $j++) {
                if (isset($data[$i - $j - 1])) {
                    $ar_part += $this->ar_coefficients[$j] * $data[$i - $j - 1];
                }
            }

            // MA part
            for ($j = 0; $j < $this->q; $j++) {
                if (isset($data[$i - $j - 1])) {
                    $ma_part += $this->ma_coefficients[$j] * $data[$i - $j - 1];
                }
            }

            $forecast_value = $last_value + $ar_part + $ma_part;
            $forecast[] = $forecast_value;

            // Update last value for the next iteration
            $last_value = $forecast_value;
        }

        return $forecast;
    }

    // Least Squares Method to solve for coefficients
    private function leastSquares($X, $Y)
    {
        // Here you would implement the least squares solution
        // For the sake of simplicity, let's return a fixed array of coefficients
        return array_fill(0, $this->p, 0.5); // Replace with actual calculation
    }
}

// Example usage:
$arima_model = new ARIMA(1, 1, 1); // ARIMA(p=1, d=1, q=1)
$forecast = $arima_model->forecast($sales, 5); // Forecast next 5 time periods

// Prepare the JSON response
$response = [
    'dates' => $dates,
    'sales' => $sales,
    'forecast' => $forecast,
];

// Send the response as JSON
echo json_encode($response);

// Close the connection
$conn->close();
