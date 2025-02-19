<?php
include '../includes/database.php';

$sql = "SELECT * FROM orders";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellingen</title>
</head>
<body>

<h1>Bestellingen</h1>

<table>
    <thead>
        <tr>
            <th>Domeinnaam</th>
            <th>TLD</th>
            <th>Prijs</th>
            <th>Status</th>
            <th>Datum</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order['domain_name'] . '.' . $order['tld'] ?></td>
                <td><?= $order['tld'] ?></td>
                <td>€<?= number_format((float)$order['price'], 2, ',', '.') ?></td>
                <td><?= ucfirst($order['status']) ?></td>
                <td><?= $order['created_at'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
