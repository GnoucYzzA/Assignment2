<!DOCTYPE html>
<html>
<body>

<h1>DELETE DATA FROM DATABASE</h1>

<?php
ini_set('display_errors', 1);
echo "Insert database!";
?>

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

$sql = "DELETE FROM sneakertoy WHERE toyid = '$_POST[ToyID]'";
$stmt = $pdo->prepare($sql);

if(is_null ($_POST[ToyID]) == FALSE) {
    if($stmt->execute() == TRUE){
        echo "Record deleted successfully.";
}   else {
        echo "Error deleting record: ";
}}

?>
</body>
</html>
