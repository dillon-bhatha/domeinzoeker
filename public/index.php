<?php
include '../includes/database.php';

$url = 'https://dev.api.mintycloud.nl/api/v2.1/domains/search?with_price=true';

$tlds = ['com', 'net', 'org', 'nl', 'eu', 'co', 'info', 'biz', 'us', 'xyz'];

$errorMessage = '';
$domainInfo = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['domain_name']) && isset($_POST['tld'])) {
    $domain_name = $_POST['domain_name'];
    $tld = $_POST['tld'];

    if (!empty($domain_name) && !empty($tld)) {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE domain_name = ? AND tld = ?");
        $stmt->bind_param("ss", $domain_name, $tld);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $errorMessage = "Dit domein bestaat al in je bestellingen.";
        } else {
            $domains = [['name' => $domain_name, 'extension' => $tld]];
            $data_json = json_encode($domains);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Basic 072dee999ac1a7931c205814c97cb1f4d1261559c0f6cd15f2a7b27701954b8d",
                "Content-Type: application/json"
            ]);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                $errorMessage = 'Curl error: ' . curl_error($ch);
            } else {
                $domainInfo = json_decode($response, true);
            }
            curl_close($ch);
        }
    } else {
        $errorMessage = 'Vul een domeinnaam en TLD in.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domeinzoeker</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h1>Minty Stage opdracht Domein Zoeker</h1>

<form method="POST" action="">
    <input type="text" name="domain_name" placeholder="Domeinnaam" required>
    <select name="tld" required>
        <?php foreach ($tlds as $tld): ?>
            <option value="<?= $tld ?>"><?= $tld ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Zoek Domein</button>
</form>

<?php if ($domainInfo): ?>
    <?php
    if (isset($domainInfo[0]['domain'])) {
        $full_domain = $domainInfo[0]['domain'];
        $domain_parts = explode('.', $full_domain);
        $domain_name = $domain_parts[0];
        $tld = isset($domain_parts[1]) ? $domain_parts[1] : '';

        $price = 'Onbekend';
        if (isset($domainInfo[0]['price']['product']['price']) && is_numeric($domainInfo[0]['price']['product']['price'])) {
            $price = number_format((float)$domainInfo[0]['price']['product']['price'], 2, ',', '.');
        }
    }
    ?>

    <div class="result">
        <h2>Resultaten voor <?= htmlspecialchars($domain_name) ?>.<?= htmlspecialchars($tld) ?></h2>
        <p><strong>Status:</strong> <?= ucfirst($domainInfo[0]['status']) ?></p>
        <p><strong>Domeinnaam:</strong> <?= htmlspecialchars($domain_name) ?></p>
        <p><strong>TLD:</strong> <?= htmlspecialchars($tld) ?></p>
        <p><strong>Prijs:</strong> €<?= $price ?></p>

        <?php if ($domainInfo[0]['status'] == 'free' && !$errorMessage): ?>
            <form method="POST" action="cart.php">
                <input type="hidden" name="domain_name" value="<?= htmlspecialchars($domain_name) ?>">
                <input type="hidden" name="tld" value="<?= htmlspecialchars($tld) ?>">
                <input type="hidden" name="price" value="<?= $price ?>">
                <input type="hidden" name="status" value="<?= $domainInfo[0]['status'] ?>">
                <button type="submit">Voeg toe aan winkelmand</button>
            </form>
        <?php elseif ($domainInfo[0]['status'] != 'free'): ?>
            <p>Dit domein is niet beschikbaar.</p>
        <?php endif; ?>
    </div>
<?php endif; ?>

<a href="orders.php">Overzicht</a>

<?php if ($errorMessage): ?>
    <p class="error"><?= $errorMessage ?></p>
<?php endif; ?>

</body>
</html>
