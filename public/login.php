<?php

session_start();

if (isset($_POST["email"]) && isset($_POST["password"])) {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (!empty($email) && !empty($password)) {

        $_SESSION["logged_in"] = true;
        $_SESSION["email"] = $email;

        header("Location: dashboard.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Student Expense Tracker</title>

    <link rel="stylesheet" href="css/style.css">
   ```html
<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    min-height: 100vh;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #dceaff, #f7faff);
    color: #17365d;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.login-container, .login-box, .form-container {
    width: 100%;
    max-width: 440px;
    background: #ffffff;
    padding: 38px;
    border-radius: 18px;
    box-shadow: 0 12px 35px rgba(20, 75, 140, 0.16);
}

h1, h2 {
    color: #1459b5;
    text-align: center;
    margin-bottom: 12px;
}

p {
    color: #647994;
}

label {
    display: block;
    color: #234a78;
    font-weight: bold;
    margin: 14px 0 8px;
}

input, select, textarea {
    width: 100%;
    padding: 13px;
    margin: 5px 0 15px;
    border: 1px solid #c8d9ef;
    border-radius: 8px;
    background: #f8fbff;
    color: #17365d;
    font-size: 15px;
}

input:focus, select:focus, textarea:focus {
    outline: none;
    border-color: #1769d2;
    box-shadow: 0 0 0 3px rgba(23, 105, 210, 0.12);
}

button, input[type="submit"], .btn {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 8px;
    background: #1769d2;
    color: #ffffff;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

button:hover, input[type="submit"]:hover, .btn:hover {
    background: #0b4ca3;
}

a {
    color: #1769d2;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

.register-link {
    text-align: center;
    margin-top: 20px;
}

.error {
    color: #b42318;
    background: #fff0ef;
    padding: 12px;
    border-radius: 8px;
}

.success {
    color: #087443;
    background: #e8fff2;
    padding: 12px;
    border-radius: 8px;
}
</style>


</head>

<body class="login-body">

<div class="login-container">

    <div class="login-box">

        <div class="login-icon">₹</div>

        <h1>Welcome Back</h1>

        <p class="login-subtitle">
            Login to manage your expenses
        </p>

        <form method="POST" action="login.php">

            <label>Email Address</label>

            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required
            >

            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Enter your password"
                required
            >

            <button type="submit" class="primary-btn login-btn">
                Login →
            </button>

        </form>

        <a href="index.php" class="back-home">
            ← Back to Home
        </a>

    </div>

</div>

</body>
</html>