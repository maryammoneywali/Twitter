<?php
$host = "localhost";
$user = "uzhgdjrzxrysx";
$password = "v0t4cp0bmkrb";
$db = "dbbh56eisdordq";

$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
