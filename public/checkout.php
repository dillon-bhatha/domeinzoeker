<?php
session_start();
include '../includes/database.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$subtotaal = 0;
foreach ($_SESSION['cart'] as $item) {
    $subtotaal += floatval(str_replace(',', '.', $item['price']));
}
$btw = $subtotaal * 0.21;
$totaal = $subtotaal + $btw;

$orderPlaced = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order']) && !empty($_SESSION['cart'])) {
    $stmt = $conn->prepare("INSERT INTO orders (domain_name, tld, price, tax, total_price, status) VALUES (?, ?, ?, ?, ?, 'pending')");

    foreach ($_SESSION['cart'] as $item) {
        $stmt->bind_param("ssddd", $item['domain_name'], $item['tld'], $item['price'], $btw, $totaal);
        $stmt->execute();
    }
    $stmt->close();

    $_SESSION['cart'] = [];
    $orderPlaced = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Checkout</h1>

<div class="content">
    <?php if ($orderPlaced): ?>
        <div class="success-message">
            ✅ <strong>Bestelling succesvol geplaatst!</strong>
        </div>
    <?php elseif ($subtotaal > 0): ?>
        <div class="order-summary">
            <p><strong>Subtotaal:</strong> €<?= number_format($subtotaal, 2, ',', '.') ?></p>
            <p><strong>BTW (21%):</strong> €<?= number_format($btw, 2, ',', '.') ?></p>
            <p><strong>Totaal:</strong> €<?= number_format($totaal, 2, ',', '.') ?></p>

            <form method="POST">
                <button type="submit" name="place_order">Bestelling plaatsen</button>
            </form>
        </div>
    <?php else: ?>
        <div class="error-message">
            Je winkelmand is leeg.
        </div>
    <?php endif; ?>

    <div class="links">
        <a href="index.php">Terug naar home</a>
        <a href="cart.php">Terug naar winkelmand</a>
    </div>
</div>

</body>
</html>
