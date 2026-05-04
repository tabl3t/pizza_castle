#  PIZZACASTLE - E-Commerce Web Application

PIZZACASTLE is a full-stack, role-based food ordering system built with PHP and MySQL. It features a complete customer journey from account creation to checkout, alongside a secure Admin dashboard for menu and order management.

##  Features

**For Customers:**
* Secure User Registration & Login (Password Hashing).
* Browse dynamic, database-driven pizza menus.
* Add items to a shopping cart, update quantities, and clear the cart.
* Seamless checkout process generating unique Order IDs.

**For Administrators:**
* Role-based access control (Admin vs. Customer routing).
* Manage Menu: Add new pizzas or remove existing ones (Soft delete to preserve order history).
* Order Management: View active orders in real-time and update fulfillment statuses (Pending/Delivered).

##  Tech Stack
* **Frontend:** HTML5, Vanilla CSS (Flexbox, Grid, Custom UI)
* **Backend:** Procedural PHP 
* **Database:** MySQL
* **Security:** `password_hash()`, `mysqli_real_escape_string`, and Prepared Statements for database interactions.

##  Local Setup
1. Clone this repository.
2. Start your local server (XAMPP/WAMP/MAMP).
3. Import the `pizza_castle_db.sql` file into your MySQL database.
4. Update the `db.php` credentials if necessary.
5. Navigate to `login.php` in your browser.
