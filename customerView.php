<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include('db.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Menu | PIZZACASTLE</title>
    <style>
        body { background-color: #1B211A; font-family: monospace; font-size: 150%; min-height: 100vh; margin: 0; }
        .container { background-color: #EBD5AB; width: 100%; padding: 20px 50px; display: flex; justify-content: space-between; align-items: center; box-sizing: border-box; }
        .brand { color: #1B211A; font-weight: bold; font-size: 180%; }
        .container a { color: #1B211A; font-weight: bold; font-size: 1.5rem; text-decoration: none; }
        h2 { background-color: #8BAE66; width: 100%; padding: 15px; text-align: center; font-size: 2rem; margin-top: 0px; border-radius: 5px; box-sizing: border-box; }
        .main-layout { display: flex; max-width: 1200px; margin: 0 auto; gap: 20px; padding: 20px; align-items: flex-start; }
        .menu-section { flex: 7; }
        .cart-section { flex: 3; position: sticky; top: 20px; }
        .pizza-card { background-color: #EBD5AB; padding: 20px; margin-bottom: 20px; border-radius: 10px; display: flex; justify-content: space-between; align-items: center; }
        .cart-container { background-color: #F0FFC2; padding: 20px; border-radius: 15px; border: 2px solid #1B211A; color: #1B211A; }
        .action-btn { background-color: #1B211A; color: #EBD5AB; border: none; padding: 10px; border-radius: 5px; cursor: pointer; font-family: monospace; width: 100%; text-decoration: none; text-align: center; display: block; margin-top: 10px;}
    </style>
</head>
<body>
    <div class="container">
        <div class="brand">PIZZACASTLE</div>
        <div style="display: flex; gap: 20px; align-items: center;">
            <a href="logout.php">Log Out</a>
        </div>
    </div>

    <div class="main-layout">
        <div class="menu-section">
            <h2>Menu</h2>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM pizzas WHERE is_active = 1");
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="pizza-card">
                <div>
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p>$<?php echo number_format($row['price'], 2); ?></p>
                </div>
                <form action="manage_cart.php" method="POST">
                    <input type="hidden" name="pizza_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="item_name" value="<?php echo $row['name']; ?>">
                    <input type="hidden" name="item_price" value="<?php echo $row['price']; ?>">
                    <button type="submit" name="add_to_cart" class="action-btn" style="width: auto; padding: 10px 20px;">Add</button>
                </form>
            </div>
            <?php } ?>
        </div>

        <div class="cart-section">
            <div class="cart-container">
                <h3>Your Cart</h3>
                <?php if (!empty($_SESSION['cart'])) { 
                    $total = 0;
                    foreach ($_SESSION['cart'] as $item) { 
                        $total += ($item['price'] * $item['quantity']); ?>
                        <p><?php echo $item['name']; ?> x<?php echo $item['quantity']; ?></p>
                    <?php } ?>
                    <hr>
                    <p>Total: $<?php echo number_format($total, 2); ?></p>
                    <a href="checkout.php" class="action-btn" style="background-color: #8BAE66; color: #1B211A;">Checkout</a>
                    <a href="manage_cart.php?action=clear" class="action-btn" style="background-color: #ff4d4d; color: white;">Clear</a>
                <?php } else { echo "<p>Empty</p>"; } ?>
            </div>
        </div>
    </div>
</body>
</html>