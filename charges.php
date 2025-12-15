<?php 
session_start();
$name = $_POST["name"];
$account = $_POST["account"];
$type = $_POST["type"];
$extra = $_POST["extra"];
$package = $_POST["package"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Billing
    </title>
</head>
<body>
    
<h1> Internet Usage Bill of Account Number <?php echo $account; ?> </h1>
<p> <strong> Customer Name : <?php echo $name ?> </strong> </p>
<br>
<p> <strong> Internet Package: <?php echo $package ?> </strong> </p>
<br>
<hr>
<table rowspan = "2">
    <tr>
        <th></th>
        <th> Units </th>
        <th> Amount </th>
</tr>

<tr>
<td>
Rental: <?php echo $type; ?> </td>
<td>  </td>
<td> 
    <?php if($type == "fiber"){
        echo "Rs.". 760 ;
        $fiber = 760; 
    } else {
        echo "";
        $fiber = 0;
    }
    ?>
</td>
</tr>
<tr>
    <td> Monthly Rental </td>
    <td> </td>
    <td> 
        <?php 
        switch($package){
            case 'Basic':
                echo "Rs." . 760;
                $pack = 760; 
                break;
            case 'Web Lite' : 
                echo "Rs." . 1520;
                $pack = 1520;
                break;
            case 'Any Blast' :
                echo "Rs." . 2340; 
                $pack = 2340;
                break;
             case 'Family Plan' :
                 echo "Rs." . 3790;
                 $pack = 3790; 
            }
?>
</td>
        </tr>
  <tr>
    <td> Extra GB used </td>
    <td>  <?php echo $extra ?> </td>
            <td> 
                <?php 
               $charges = 0; 
               if($extra<5){
                $charges = 100 * $extra; 
                echo "Rs." . $charges;
                
               }elseif($extra <20){
                $charges = 4 * 100; 
                $gb = $extra - 4;
                $charges +=( $gb *85); 
                echo "Rs." . $charges;

               }elseif($extra < 50){
                $charges = 4*100 + 85*15; 
                $gb = $extra - 19; 
                $charges += ($gb * 75); 
                echo "Rs." . $charges; 
                
            
               }elseif($extra >= 50){
                $charges = 4*100 + 85*15 + 30*75; 
                $gb = $extra - 49; 
                $charges += ($gb * 60); 
                echo "Rs." . $charges; 

               }
            ?>
            </td>

        </tr>
 <tr> 
    <td> Total </td>
    <td>  </td>
    <td> <?php 
$total = $charges + $pack + $fiber; 
echo "Rs." . $total; 


?>

        </td>

        </tr>
        </table>



</body>
</html>