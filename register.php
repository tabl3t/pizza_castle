<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | PIZZACASTLE</title>
    <style>
        body {
            background-color: #1B211A;
            font-family: monospace;
            font-size: 150%;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .brand {
            color: #1B211A;
            font-weight: bold;
            font-size: 180%;
            text-align: center;
        }
        .form-container {
            font-family: monospace;
            text-align: left;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(255,255,255,0.3);
            min-height: 500px;
            width: 450px;
            background-color: #EBD5AB;
            padding: 40px;
            box-sizing: border-box;
        }
        h1 {
            margin: 25px 0px;
            font-family: sans-serif;
            font-size: 1.5rem;
            color: #1B211A;
            text-align: center;
        }
        label {
            font-weight: bold;
            font-size: 20px;
            color: #1B211A;
        }
        input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            margin: 8px 0 20px 0;
        }
        .btn {
            cursor: pointer;
            width: 100%;
            padding: 15px;
            background-color: #1B211A;
            color: #EBD5AB;
            border: none;
            border-radius: 5px;
            font-size: 1.5rem;
            font-family: monospace;
            transition: 0.3s;
        }
        .btn:hover {
            background-color: #3e4d3c;
        }
        .links {
            margin-top: 20px;
            font-size: 20px;
            text-align: center;
        }
        .links a {
            color: #1B211A;
            font-weight: bold;
            text-decoration: none;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="brand">PIZZACASTLE</div>
        <h1>Sign Up Now!</h1>
        <form action="register_logic.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Type your username..." required>
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="yourmail@gmail.com" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" name="register_user" class="btn">Register</button>
        </form>
        <div class="links">
            Already have an account? <a href="login.php">Log in here</a>
        </div>
    </div>
</body>
</html>