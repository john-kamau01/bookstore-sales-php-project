<?php
// config.php
$mysqli = new mysqli("localhost", "root", "", "bookstore_sales_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>