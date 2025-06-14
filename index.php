<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
$username = $_SESSION['username'];
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Twitter Clone - Home</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background: linear-gradient(to bottom, #d7f1ff, #dee3e6);
        }
        .header {
            background-color: #b0d8f7;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            color: #2e5d7a;
        }
        .welcome {
            padding: 20px;
            text-align: center;
            color: #375972;
            font-size: 20px;
        }
        .tweet-box {
            width: 60%;
            margin: 20px auto;
            background-color: #f5f9fc;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(80, 120, 160, 0.2);
        }
        textarea {
            width: 100%;
            height: 80px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #b3c6d4;
            border-radius: 6px;
            resize: none;
        }
        .tweet-btn {
            background-color: #6abfff;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            border-radius: 6px;
            cursor: pointer;
            float: right;
        }
        .tweet-btn:hover {
            background-color: #419ee2;
        }
        .logout-btn {
            display: block;
            width: 200px;
            margin: 30px auto;
            background-color: #67bff7;
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #449de1;
        }
        .tweet-feed {
            width: 60%;
            margin: 20px auto;
        }
        .tweet {
            background-color: white;
            border-left: 5px solid #b0d8f7;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(160, 180, 200, 0.2);
        }
        .tweet-user {
            font-weight: bold;
            color: #2d6a8f;
        }
        .tweet-content {
            margin-top: 8px;
            color: #333;
        }
        .tweet-time {
            font-size: 12px;
            color: #777;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">Twitter Clone</div>
    <div class="welcome">Welcome, <?php echo htmlspecialchars($username); ?> 👋</div>

    <div class="tweet-box">
        <form method="POST" action="tweet.php">
            <textarea name="tweet" placeholder="What's on your mind?" required></textarea>
            <button type="submit" class="tweet-btn">Tweet</button>
        </form>
    </div>

    <!-- Tweet Feed Section -->
    <div class="tweet-feed">
        <?php
        $result = $conn->query("SELECT * FROM tweets ORDER BY created_at DESC");
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="tweet">';
                echo '<div class="tweet-user">@' . htmlspecialchars($row['username']) . '</div>';
                echo '<div class="tweet-content">' . nl2br(htmlspecialchars($row['content'])) . '</div>';
                echo '<div class="tweet-time">' . date("F j, Y, g:i a", strtotime($row['created_at'])) . '</div>';
                echo '</div>';
            }
        } else {
            echo "<p style='text-align:center;color:#666;'>No tweets yet. Be the first to post!</p>";
        }
        ?>
    </div>

    <a href="logout.php" class="logout-btn">Logout</a>
</body>
</html>
