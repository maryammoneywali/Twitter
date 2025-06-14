<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - Twitter Clone</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #dfefff, #c4cacc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #f6f8f9;
            border: 1px solid #ccd3d8;
            border-radius: 12px;
            padding: 30px;
            width: 350px;
            box-shadow: 0 0 15px rgba(100, 130, 150, 0.2);
        }
        h2 {
            text-align: center;
            color: #325c80;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #bbc7d0;
            border-radius: 6px;
        }
        input[type="submit"] {
            background-color: #7dbfff;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #5aa9e6;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #496b8a;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Create an Account</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <input type="submit" value="Register" />
    </form>
    <a href="login.php">Already have an account? Login</a>
</div>
</body>
</html>
