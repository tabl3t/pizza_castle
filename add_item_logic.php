<?php
include('db.php');

if (isset($_POST['add_pizza'])) {
    $name = mysqli_real_escape_string($conn, $_POST['piz_name']);
    $price = mysqli_real_escape_string($conn, $_POST['piz_price']);

    $query = "INSERT INTO pizzas (name, price) VALUES ('$name', '$price')";

    if (mysqli_query($conn, $query)) {
        header("Location: adminDashboard.php?success=1");
        exit();
    } else {
        die("Error: " . mysqli_error($conn));
    }
}
?>