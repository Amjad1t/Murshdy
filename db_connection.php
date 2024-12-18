<?php
$conn = new mysqli("localhost", "root@localhost", "your_password", "murshdy");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
