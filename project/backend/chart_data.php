<?php
include 'db.php';

// Fetch total income
$sql = "SELECT SUM(amount) AS total_income FROM income";
$result = mysqli_query($conn, $sql);
$total_income = ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result)['total_income'] : 0;

// Fetch total expenses
$sql = "SELECT SUM(amount) AS total_expense FROM expense";
$result = mysqli_query($conn, $sql);
$total_expense = ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result)['total_expense'] : 0;

// Calculate total amount
$total_amount = $total_income - $total_expense;

// Prepare data as JSON
$data = array(
    'income' => $total_income,
    'expenses' => $total_expense,
    'totalAmount' => $total_amount
);

// Send data as JSON response
header('Content-Type: application/json');
echo json_encode($data);

mysqli_close($conn);
?>
