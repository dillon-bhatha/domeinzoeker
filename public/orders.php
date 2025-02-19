<?php
include '../includes/database.php';

try {
    $sql = "SELECT domain_name, tld, price, tax, total_price, status, created_at FROM orders ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = $result->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    die("Fout bij het ophalen van bestellingen: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellingen</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Bestellingen</h1>

<table>
    <thead>
        <tr>
            <th>Domeinnaam</th>
            <th>TLD</th>
            <th>Prijs</th>
            <th>BTW (21%)</th>
            <th>Totaal</th>
            <th>Status</th>
            <th>Datum</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= htmlspecialchars($order['domain_name']) . '.' . htmlspecialchars($order['tld']) ?></td>
                    <td><?= htmlspecialchars($order['tld']) ?></td>
                    <td>€<?= number_format((float)$order['price'], 2, ',', '.') ?></td>
                    <td>€<?= number_format((float)$order['tax'], 2, ',', '.') ?></td>
                    <td>€<?= number_format((float)$order['total_price'], 2, ',', '.') ?></td>
                    <td><?= ucfirst(htmlspecialchars($order['status'])) ?></td>
                    <td><?= htmlspecialchars($order['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Geen bestellingen gevonden.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<a href="index.php">Terug naar home</a>

</body>
</html>
