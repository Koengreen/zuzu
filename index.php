<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=zuzu", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
$stmt = $conn->prepare("SELECT * FROM `sushi` where amount>0");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);



while (true) { //act like this while isnt here

$Table = "<table> <tr> <th>Naam</th><th>Prijs in euro</th><th>voorraad</th> </tr>";
$Data = "";
// set the resulting array to associative
foreach ($result as $i) 
{
    $id = $i['id'];
    $Name = $i['name'];
    $price = $i['price'];
    $amount = $i['amount'];
    $Data = "$Data <option value='$Name' selected='true'>$Name ($amount)</option>";
    $Table = "$Table <tr> <td>$Name</td> <td>$price</td> <td>$amount</td><tr>";
}
$Table = "$Table </table>";

echo $Table;








if (@$_POST) 
{
$Name = $_POST['Name'];
$sushi = $_POST['sushi'];
$Adress = $_POST['Address'];
$City = $_POST['City'];
$ZipCode= $_POST['Zipcode'];
$amount = $_POST['Amount'];
var_dump($sushi);
if (!ctype_digit($amount)) 
{
     echo "<h1>please fill in a valid number!</h1>";
     break;
}
$stmt = $conn->prepare("SELECT sushi.amount-$amount as 'result' FROM `sushi` WHERE sushi.name = 'lobster sushi'");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);







if ($result[0]['result'] > -1) {

echo "Order has been recieved";
$stmt = $conn->prepare("INSERT INTO `customer` (`id`, `fname`, `sushiName`, `address`, `city`, `zipcode`, `Amount`) VALUES (NULL, '$Name', '$sushi', '$Adress', '$City', '$ZipCode', '22');");
$stmt->execute();
$querry = "UPDATE `sushi` SET `amount` = `amount` - '$amount' WHERE `sushi`.`name` = '$sushi'";

$stmt = $conn->prepare("$querry");
$stmt->execute();
} else {echo "your order is too big!";}

}

break;
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
table, th, td {
  border:1px solid black;
}
</style>


<div class="rendered-form">
    <form method="post">
    <div class="formbuilder-text form-group field-Name">
        <label for="Name" class="formbuilder-text-label">Naam<span class="formbuilder-required">*</span></label>
        <input type="text" placeholder="Type your Name here" class="form-control" name="Name" access="false" id="Name" required="required" aria-required="true">
    </div>
    <div class="formbuilder-text form-group field-adress">
        <label for="adress" class="formbuilder-text-label">Adres<span class="formbuilder-required">*</span></label>
        <input type="text" class="form-control" name="Address" access="false" id="Address" required="required" aria-required="true">
    </div>
    <div class="formbuilder-text form-group field-City">
        <label for="City" class="formbuilder-text-label">Stad<span class="formbuilder-required">*</span></label>
        <input type="text" class="form-control" name="City" access="false" id="City" required="required" aria-required="true">
    </div>
    <div class="formbuilder-text form-group field-Zipcode">
        <label for="Zipcode" class="formbuilder-text-label">Postcode<span class="formbuilder-required">*</span></label>
        <input type="text" class="form-control" name="Zipcode" access="false" id="Zipcode" required="required" aria-required="true">
    </div>
    <div class="formbuilder-text form-group field-Zipcode">
        <label for="Zipcode" class="formbuilder-text-label">Aantal<span class="formbuilder-required">*</span></label>
        <input type="text" class="form-control" name="Amount" access="false" id="Amount" required="required" aria-required="true">
    </div>
    <div class="formbuilder-select form-group field-sushi">
        <label for="sushi" class="formbuilder-select-label">Soort</label>
        <select class="form-control" name="sushi" id="sushi">
         <?php echo $Data?>
        </select>
    </div>
    <div class="formbuilder-text form-group field-Zipcode">
    <input type="submit" value="Submit">
    </div>
    </form>
</div>



</body>
</html>