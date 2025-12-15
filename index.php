<?php
session_start();

$values = [
    "name" => "",
    "account" => "",
    "type" => "",

    "package" => "",
    "extra" => ""
];

function clean($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($values as $key => $value) {
        if (isset($_POST[$key])) {
            $values[$key] = clean($_POST[$key]);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Selection & Billing</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Internet Billing System</h1>

    <form method="post" action="charges.php">

        <div class="field">
            <label>Client Name</label>
            <input type="text" name="name" required value="<?= $values['name']; ?>">
        </div>

        <div class="field">
            <label>Account Number</label>
            <input type="text" name="account" required value="<?= $values['account']; ?>">
        </div>

        <div class="field radio-group">
            <label>Connection Type</label>
            <label>
                <input type="radio" name="type" value="4g" <?= ($values['type'] === "4g") ? "checked" : ""; ?>> 4G
            </label>
            <label>
                <input type="radio" name="type" value="fiber" <?= ($values['type'] === "fiber") ? "checked" : ""; ?>> Fiber
            </label>
        </div>

        <div class="field">
            <label>Internet Package</label>
            <select name="package" required>
                <option value="">Select Package</option>
                <?php
                $packages = ['Basic', 'Web Lite', 'Any Blast', 'Family Plan'];
                foreach ($packages as $p) {
                    $selected = ($values['package'] === $p) ? "selected" : "";
                    echo "<option value='$p' $selected>$p</option>";
                }
                ?>
            </select>
        </div>

        <div class="field">
            <label>Extra GB Used</label>
            <input type="number" name="extra" min="0" value="<?= $values['extra']; ?>">
        </div>

        <button type="submit">Calculate Bill</button>

    </form>
</div>

</body>
</html>
