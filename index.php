<?php
session_start();
$values=[
    "name" => "",
    "account" => "",
    "type" => "",
    "package" => [],
    "extra" => "", 
];

function test_input($data){
    return htmlspecialchars(stripslashes(trim($data)));
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $values["name"] = test_input($_POST['name']);
    $values["account"] = test_input($_POST['account']);
    $values["type"] = test_input($_POST['type']);
    $values["package"] = test_input($_POST['package']);
    $values["extra"] = test_input($_POST['extra']);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Selection & Billing</title>
</head>
<body>
    <div class = "container">
<form method = "post" action="charges.php">
    <div class = "field">
<label> Client's name </label>
<input type = "text" name = "name" value = " <?php echo $values["name"]; ?> ">
<br>
</div>

<div class = "field">
    <label> Account number </label>
    <input type = "text" name = "account" value = " <?php echo $values["account"]; ?> ">
<br>
</div>    


<div class = "field">
    <label> Type </label>
    <input type = "radio" name = "type" value = "4g" <?php if($values["type"]=="4g") echo "selected"; ?> > 4G <br> 
<input type = "radio" name = "type" value = "fiber" <?php if($values["type"]=="fiber") echo "selected"; ?> > Fiber <br>
</div>

<div class = "field">
<label> Internet Package </label>
<select name = "package" >
<option value = ""> Select Package </option>
<?php
$package = ['Basic', 'Web Lite', 'Any Blast', 'Family Plan'];
foreach($package as $p){
    $Selected = ($values["package"] == $p) ? "selected" : "";
    ?>
<option value = "<?php echo $p ?>" $Selected> <?php echo $p ?> </option> 
<?php } ?>

</select>




<br>
</div>


<div class ="field">
    <label> Extra GB used </label>
    <input type = "number" name = "extra" value = " <?php echo $values["extra"]; ?> " > 
</div>

<button type ="submit" action = "charges.php" > Calculate </button>




</body>
</html>