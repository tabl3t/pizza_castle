<?php
session_start();
include('db.php');
if (!isset($_SESSION['user_id']) || empty($_SESSION['cart'])) {
    header("Location: customerView.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$total_amount = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_amount += $item['price'] * $item['quantity'];
}
$query = "INSERT INTO orders (user_id, total_amount, status) VALUES ('$user_id', '$total_amount', 'pending')";
if (mysqli_query($conn, $query)) {
    $order_id = mysqli_insert_id($conn);
    foreach ($_SESSION['cart'] as $item) {
        $pizza_id = $item['id'];
        $qty = $item['quantity'];
        mysqli_query($conn, "INSERT INTO order_items (order_id, pizza_id, quantity) VALUES ('$order_id', '$pizza_id', '$qty')");
    }
    unset($_SESSION['cart']);
    header("Location: customerView.php");
    exit();
} else {
    die("Error: " . mysqli_error($conn));
}
?>