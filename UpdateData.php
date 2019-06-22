<!DOCTYPE html>
<html>
<body>

<h1>UPDATE DATA TO DATABASE</h1>

<?php
ini_set('display_errors', 1);
echo "Update database!";
?>

<ul>
    <form name="UpdateData" action="UpdateData.php" method="POST" >
    <li>Toy ID:</li><li><input type="text" name="ToyID" /></li>
    <li>Toy Name:</li><li><input type="text" name="ToyName" /></li>
    <li>Price:</li><li><input type="text" name="Price" /></li>
    <li>Date:</li><li><input type="text" name="Date" /></li>
    <li><button type="submit" value="submit">Update</button> </li>
</form>
</ul>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-54-83-9-36.compute-1.amazonaws.com;port=5432;user=mnvkrpgighmovm;password=ec88450374a0be701bd72da2753e03f48af3f3e48c9644b862a58dd677d22cd5;dbname=dfv6jafh0t2m8e",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  


$sql = "UPDATE sneakertoy SET tname = '$_POST[ToyName]',unitprice = '$_POST[Price]', checkdate = '$_POST[Date]' WHERE toyid = '$_POST[ToyID]'";
$stmt = $pdo->prepare($sql);

if(is_null($_POST[ToyID]) == FALSE){
if($stmt->execute() == TRUE){
    echo "Record updated successfully.";
} else {
    echo "Error updating record. ";
}}
    
?>
</body>
</html>
