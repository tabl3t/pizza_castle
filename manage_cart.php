<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $pizza_id = $_POST['pizza_id'];

    $result = mysqli_query($conn, "SELECT name, price FROM pizzas WHERE id = '$pizza_id' AND is_active = 1");
    $pizza = mysqli_fetch_assoc($result);

    if ($pizza) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $pizza_id) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $_SESSION['cart'][] = [
                'id' => $pizza_id,
                'name' => $pizza['name'],
                'price' => $pizza['price'],
                'quantity' => 1
            ];
        }
    }
    header("Location: customerView.php");
    exit();
}

if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    unset($_SESSION['cart']);
    header("Location: customerView.php");
    exit();
}
?>