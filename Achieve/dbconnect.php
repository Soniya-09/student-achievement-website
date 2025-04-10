<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "achievement";
$port = '3307';

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname;port=$port", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}



?>
