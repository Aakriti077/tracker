<?php
// Include your database connection code
include './login/db.php';

// Retrieve and decode JSON data
$data = json_decode(file_get_contents("php://input"), true);

// Example: Insert the income data into the database
$date = $data['date'];
$category = $data['category'];
$item = $data['item'];
$amount = $data['amount'];
$details = $data['details'];

// Example SQL query to insert income data
$sql = "INSERT INTO expense (date, category, item, amount, details) VALUES ('$date', '$category', '$item', '$amount', '$details')";

if (mysqli_query($conn, $sql)) {
    // If the query is successful
    http_response_code(200);
    echo json_encode(array("message" => "Expense added successfully"));
} else {
    // If there's an error in the query
    http_response_code(500);
    echo json_encode(array("message" => "Error adding expense: " . mysqli_error($conn)));
}

// Close database connection
mysqli_close($conn);
?>
