<?php
require_once "config.php";

$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "✅ Tables in the database:<br>";
    while ($row = $result->fetch_array()) {
        echo $row[0] . "<br>";
    }
} else {
    echo "❌ No tables found in the database!";
}
?>
