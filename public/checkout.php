<?php
session_start();

$subTotal = 0;
$taxRate = 0.21;

if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $item) {
        echo '<pre>';
        var_dump($item['price']);
        echo '</pre>';

        if (isset($item['price'])) {
            $price = str_replace(',', '.', $item['price']);
            if (is_numeric($price)) {
                $subTotal += (float)$price;
            }
        }
    }

    $tax = $subTotal * $taxRate;
    $total = $subTotal + $tax;
} else {
    $subTotal = 0;
    $tax = 0;
    $total = 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../includes/database.php';

    foreach ($_SESSION['cart'] as $item) {
        if (isset($item['price'])) {
            $price = str_replace(',', '.', $item['price']);
            if (is_numeric($price)) {
                $sql = "INSERT INTO orders (domain_name, tld, price) VALUES (:domain_name, :tld, :price)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    'domain_name' => $item['domain_name'],
                    'tld' => $item['tld'],
                    'price' => (float)$price
                ]);
            }
        }
    }

    unset($_SESSION['cart']);

    $_SESSION['order_success'] = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        button {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>

<h1>Checkout</h1>

<?php if (isset($_SESSION['order_success']) && $_SESSION['order_success']): ?>
    <p style="color: green;"><strong>Succesvol besteld!</strong></p>
    <?php unset($_SESSION['order_success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
    <p><strong>Subtotaal:</strong> €<?= number_format($subTotal, 2, ',', '.') ?></p>
    <p><strong>BTW (21%):</strong> €<?= number_format($tax, 2, ',', '.') ?></p>
    <p><strong>Totaal:</strong> €<?= number_format($total, 2, ',', '.') ?></p>

    <form method="POST" action="">
        <button type="submit" class="btn-primary">Bestelling plaatsen</button>
    </form>
<?php else: ?>
    <p>Je winkelmand is leeg.</p>
<?php endif; ?>

<button onclick="window.location.href='index.php';" class="btn-secondary">Terug naar Home</button>
<button onclick="window.location.href='cart.php';" class="btn-secondary">Terug naar Winkelmand</button>

</body>
</html>
