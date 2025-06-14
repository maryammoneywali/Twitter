<?php
$host = "localhost";
$user = "uzhgdjrzxrysx";
$password = "v0t4cp0bmkrb";
$db = "dbbh56eisdordq";

$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Invalid login credentials');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Twitter Clone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #e0f3ff, #c4cacc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #f7f9fa;
            border: 1px solid #d0d8dd;
            border-radius: 12px;
            padding: 30px;
            width: 350px;
            box-shadow: 0 0 15px rgba(90, 110, 130, 0.2);
        }
        h2 {
            text-align: center;
            color: #33668c;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #aab8c2;
            border-radius: 6px;
        }
        input[type="submit"] {
            background-color: #6abfff;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #409fe3;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #4d6e8b;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="submit" value="Login" />
    </form>
    <a href="register.php">Don’t have an account? Register</a>
</div>
</body>
</html>
