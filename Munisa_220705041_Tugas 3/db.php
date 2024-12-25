<?php
$host = 'localhost';
$dbname = 'coffeehouse';
$username = 'root'; // Update with your DB username if different
$password = '';     // Update with your DB password if necessary

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
