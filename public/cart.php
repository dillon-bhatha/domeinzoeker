<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_index'])) {
    $index = $_POST['remove_index'];
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['domain_name']) && isset($_POST['tld']) && isset($_POST['price'])) {
    $domain_name = $_POST['domain_name'];
    $tld = $_POST['tld'];

    $price = str_replace(',', '.', $_POST['price']);

    if (isset($_POST['status']) && $_POST['status'] == 'free') {
        $_SESSION['cart'][] = [
            'domain_name' => $domain_name,
            'tld' => $tld,
            'price' => $price
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelmand</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Winkelmand</h1>

<div class="content">
    <?php if (!empty($_SESSION['cart'])): ?>
        <div class="cart-list">
            <ul>
                <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                    <li>
                        <?= htmlspecialchars($item['domain_name']) . '.' . htmlspecialchars($item['tld']) ?> - 
                        €<?= number_format((float)$item['price'], 2, ',', '.') ?>
                        <form method="POST" action="cart.php" style="display:inline;">
                            <input type="hidden" name="remove_index" value="<?= $index ?>">
                            <button type="submit">Verwijderen</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="links">
            <a href="checkout.php">Ga naar de checkout</a>
        </div>
    <?php else: ?>
        <div class="empty-cart">
            Je winkelmand is leeg.
        </div>
    <?php endif; ?>

    <div class="links">
        <a href="index.php">Terug naar home</a>
    </div>
</div>

</body>
</html>
