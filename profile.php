<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$profile_id = $_GET['user_id'] ?? null;
if (!$profile_id) {
    echo "User not found!";
    exit;
}

// Fetch user info
$user_query = $conn->prepare("SELECT username FROM users WHERE id = ?");
$user_query->bind_param("i", $profile_id);
$user_query->execute();
$user_result = $user_query->get_result();
$user_data = $user_result->fetch_assoc();

if (!$user_data) {
    echo "User not found!";
    exit;
}

// Check if logged-in user is already following
$follow_query = $conn->prepare("SELECT * FROM follows WHERE follower_id = ? AND following_id = ?");
$follow_query->bind_param("ii", $_SESSION['user_id'], $profile_id);
$follow_query->execute();
$is_following = $follow_query->get_result()->num_rows > 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($user_data['username']) ?>'s Profile</title>
</head>
<body>
    <h2><?= htmlspecialchars($user_data['username']) ?>'s Profile</h2>
    <a href="index.php">Home</a>
    
    <!-- Follow/Unfollow Button -->
    <form action="follow.php" method="POST">
        <input type="hidden" name="following_id" value="<?= $profile_id ?>">
        <?php if ($is_following): ?>
            <button type="submit" name="unfollow">Unfollow</button>
        <?php else: ?>
            <button type="submit" name="follow">Follow</button>
        <?php endif; ?>
    </form>

    <h3>User's Tweets</h3>
    <?php
    $tweets_query = $conn->prepare("SELECT content, created_at FROM tweets WHERE user_id = ? ORDER BY created_at DESC");
    $tweets_query->bind_param("i", $profile_id);
    $tweets_query->execute();
    $tweets_result = $tweets_query->get_result();

    while ($tweet = $tweets_result->fetch_assoc()): ?>
        <div>
            <p><?= htmlspecialchars($tweet['content']) ?></p>
            <small><?= $tweet['created_at'] ?></small>
            <hr>
        </div>
    <?php endwhile; ?>
</body>
</html>
