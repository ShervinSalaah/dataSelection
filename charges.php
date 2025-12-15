<?php
session_start();

$name    = htmlspecialchars($_POST["name"]);
$account = htmlspecialchars($_POST["account"]);
$type    = $_POST["type"];
$package = $_POST["package"];
$extra   = (int)$_POST["extra"];

/* Charges */
$fiberCharge = ($type === "fiber") ? 760 : 0;

$packageRates = [
    "Basic"       => 760,
    "Web Lite"    => 1520,
    "Any Blast"   => 2340,
    "Family Plan" => 3790
];

$packCharge = $packageRates[$package] ?? 0;

/* Extra GB Calculation */
$extraCharge = 0;
if ($extra > 0) {
    if ($extra <= 4) {
        $extraCharge = $extra * 100;
    } elseif ($extra <= 19) {
        $extraCharge = (4 * 100) + (($extra - 4) * 85);
    } elseif ($extra <= 49) {
        $extraCharge = (4 * 100) + (15 * 85) + (($extra - 19) * 75);
    } else {
        $extraCharge = (4 * 100) + (15 * 85) + (30 * 75) + (($extra - 49) * 60);
    }
}

$total = $fiberCharge + $packCharge + $extraCharge;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Billing Summary</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Internet Usage Bill</h1>

    <p><strong>Customer:</strong> <?= $name ?></p>
    <p><strong>Account Number:</strong> <?= $account ?></p>
    <p><strong>Package:</strong> <?= $package ?></p>

    <hr>

    <table>
        <tr>
            <th>Description</th>
            <th>Units</th>
            <th>Amount (Rs.)</th>
        </tr>

        <tr>
            <td>Fiber Rental</td>
            <td>-</td>
            <td><?= $fiberCharge ?></td>
        </tr>

        <tr>
            <td>Monthly Package Rental</td>
            <td>-</td>
            <td><?= $packCharge ?></td>
        </tr>

        <tr>
            <td>Extra Data Usage</td>
            <td><?= $extra ?> GB</td>
            <td><?= $extraCharge ?></td>
        </tr>

        <tr class="total-row">
            <td>Total Payable</td>
            <td></td>
            <td>Rs. <?= $total ?></td>
        </tr>
    </table>
</div>

</body>
</html>
