<?php
session_start();

// Debugging mode ON
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tweet']) && !empty(trim($_POST['tweet']))) {
        $username = $_SESSION['username'];
        $tweet = trim($_POST['tweet']);

        $stmt = $conn->prepare("INSERT INTO tweets (username, content) VALUES (?, ?)");
        if ($stmt) {
            $stmt->bind_param("ss", $username, $tweet);
            $stmt->execute();
            $stmt->close();
            echo "<script>alert('Tweet posted!'); window.location.href='index.php';</script>";
        } else {
            echo "Failed to prepare statement: " . $conn->error;
        }
    } else {
        echo "<script>alert('Tweet cannot be empty!'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>window.location.href='index.php';</script>";
}
?>
