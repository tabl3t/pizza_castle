<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
include('db.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | PIZZACASTLE</title>
    <style>
        body { background-color: #1B211A; font-family: monospace; font-size: 150%; min-height: 100vh; margin: 0; }
        .container { background-color: #EBD5AB; width: 100%; padding: 20px 50px; display: flex; justify-content: space-between; align-items: center; box-sizing: border-box; }
        .brand { color: #1B211A; font-weight: bold; font-size: 180%; }
        .container a { color: #1B211A; font-weight: bold; font-size: 1.5rem; text-decoration: none; }
        h2 { background-color: #8BAE66; width: 100%; padding: 15px; text-align: center; font-size: 2rem; margin-top: 0px; border-radius: 5px; box-sizing: border-box; }
        .main-layout { display: flex; max-width: 1200px; margin: 0 auto; gap: 20px; padding: 20px; align-items: flex-start; }
        .menu-section { flex: 7; }
        .cart-section { flex: 3; position: sticky; top: 20px; }
        .status-table { width: 100%; border-collapse: collapse; margin-top: 15px; color: #EBD5AB; }
        .status-table th, .status-table td { padding: 12px; border-bottom: 1px solid #EBD5AB; text-align: left; }
        .cart-container { background-color: #F0FFC2; padding: 20px; border-radius: 15px; border: 2px solid #1B211A; color: #1B211A; }
        input, select { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #1B211A; font-family: monospace; box-sizing: border-box; }
        .action-btn { background-color: #1B211A; color: #EBD5AB; border: none; padding: 10px; border-radius: 5px; cursor: pointer; font-family: monospace; width: 100%; }
    </style>
</head>
<body>
    <div class="container">
        <div class="brand">Admin Dashboard</div>
        <a href="logout.php">Log Out</a>
    </div>
    <div class="main-layout">
        <div class="menu-section">
            <h2>Active Orders</h2>
            <table class="status-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $orderQuery = "SELECT orders.id, users.username, orders.total_amount, orders.status FROM orders JOIN users ON orders.user_id = users.id ORDER BY orders.id DESC";
                    $orderResult = mysqli_query($conn, $orderQuery);
                    while ($order = mysqli_fetch_assoc($orderResult)) {
                    ?>
                    <tr>
                        <td>#<?php echo $order['id']; ?></td>
                        <td><?php echo $order['username']; ?></td>
                        <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                        <td><strong><?php echo $order['status']; ?></strong></td>
                        <td>
    <form action="update_order.php" method="POST" style="display: flex; gap: 5px;">
        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
        <select name="status" style="margin:0;">
            <option value="pending" <?php if($order['status']=='pending') echo 'selected'; ?>>Pending</option>
            <option value="delivered" <?php if($order['status']=='delivered') echo 'selected'; ?>>Delivered</option>
        </select>
        <button type="submit" class="action-btn">Save</button>
    </form>
</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="cart-section">
            <div class="cart-container">
                <h3>Add New Pizza</h3>
                <form action="add_item_logic.php" method="POST">
                    <input type="text" name="piz_name" placeholder="Pizza Name" required>
                    <input type="number" name="piz_price" placeholder="Price ($)" required>
                    <button type="submit" name="add_pizza" class="action-btn">Update Menu</button>
                </form>
            </div>
            <div class="cart-container" style="margin-top: 20px; background-color: #f9f0db;">
                <h3>Current Menu</h3>
                <ul style="list-style: none; padding: 0; font-size: 0.8rem;">
                    <?php

                    $pizzaQuery = "SELECT * FROM pizzas WHERE is_active = 1 ORDER BY id DESC";
                    $pizzaResult = mysqli_query($conn, $pizzaQuery);
                    while ($pizza = mysqli_fetch_assoc($pizzaResult)) {
                        ?>
                            <li>
                                <?php echo $pizza['name']; ?>
                                <a href="delete_pizza.php?id=<?php echo $pizza['id']; ?>" style="color: red;">[X]</a>
                            </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>