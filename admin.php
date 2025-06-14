<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 1) { // Assume user ID 1 is the admin
    die("Access denied!");
}

if (isset($_GET['delete_tweet'])) {
    $tweet_id = $_GET['delete_tweet'];
    $conn->query("DELETE FROM tweets WHERE id = $tweet_id");
}

if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];
    $conn->query("DELETE FROM users WHERE id = $user_id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h2>Admin Dashboard</h2>

    <h3>All Tweets</h3>
    <?php
    $result = $conn->query("SELECT tweets.id, users.username, tweets.content FROM tweets JOIN users ON tweets.user_id = users.id");
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>{$row['username']}</strong>: {$row['content']} 
        <a href='?delete_tweet={$row['id']}'>Delete</a></p>";
    }
    ?>

    <h3>All Users</h3>
    <?php
    $result = $conn->query("SELECT id, username FROM users");
    while ($row = $result->fetch_assoc()) {
        echo "<p>{$row['username']} <a href='?delete_user={$row['id']}'>Delete</a></p>";
    }
    ?>
</body>
</html>
