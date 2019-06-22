<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<body>

<h1>DATABASE CONNECTION</h1>

<?php
ini_set('display_errors', 1);
echo "Welcome to ATN company!";
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     echo '<p>The DB exists</p>';
     echo getenv("dbname");
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

$sql = "SELECT * FROM sneaker";
$stmt = $pdo->prepare($sql);
//Thiết lập kiểu dữ liệu trả về
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();
echo '<p>Students information:</p>';

?>
<div id="container">
<table class="table table-bordered table-condensed" border="1">
    <thead>
      <tr>
        <th>SneakerID</th>
        <th>SneakerName</th>
        <th>Price</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // tạo vòng lặp 
         //while($r = mysql_fetch_array($result)){
             foreach ($resultSet as $row) {
      ?>
   
      <tr>
        <td scope="row"><?php echo $row['sneakerid'] ?></td>
        <td><?php echo $row['sneakername'] ?></td>
        <td><?php echo $row['unitprice'] ?></td>
        <td><?php echo $row['checkdate'] ?></td>
        
      </tr>
     
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
