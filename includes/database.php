<?php
$host = 'localhost';
$dbname = 'domeinwinkel';
$username = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbinding mislukt: " . $e->getMessage());
}
?>