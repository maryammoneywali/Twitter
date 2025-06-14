<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_POST['following_id'])) {
    header("Location: index.php");
    exit;
}

$follower_id = $_SESSION['user_id'];
$following_id = $_POST['following_id'];

// Follow User
if (isset($_POST['follow'])) {
    $stmt = $conn->prepare("INSERT INTO follows (follower_id, following_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $follower_id, $following_id);
    $stmt->execute();
}

// Unfollow User
if (isset($_POST['unfollow'])) {
    $stmt = $conn->prepare("DELETE FROM follows WHERE follower_id = ? AND following_id = ?");
    $stmt->bind_param("ii", $follower_id, $following_id);
    $stmt->execute();
}

// Redirect back to profile
header("Location: profile.php?user_id=" . $following_id);
exit;
