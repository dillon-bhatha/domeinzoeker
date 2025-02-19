<?php
// Configuratie voor de databaseverbinding
$host = 'localhost'; // Of je serveradres
$dbname = 'domeinwinkel'; // De naam van de database
$username = 'root'; // Je MySQL gebruikersnaam

// Maak de databaseverbinding
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Verbonden met de database"; // Dit kun je uitschakelen als je wilt
} catch (PDOException $e) {
    die("Verbinding mislukt: " . $e->getMessage());
}
?>