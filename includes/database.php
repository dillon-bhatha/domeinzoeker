<?php
$servername = "localhost";
$username = "root"; // Standaard bij XAMPP of Laragon
$password = ""; // Laat leeg als je geen wachtwoord hebt ingesteld
$dbname = "domeinzoeker"; // Vervang dit met je echte database naam

$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
