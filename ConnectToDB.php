<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<body>


<div id="menu">
				<div id="menu-content">
					<!-- Navigation -->
					<label id="collapse" for="_1">
						<img  id="menuphoto" src="images/menu.svg">
					</label>
					<input id="_1" type="checkbox" name="mycheckbox"/>	
					<ul id="mainmenu">
							
						<li class="submenu">  
							<a href="ConnectToDB.php" title="Store">View Database</a>
						</li>
						<li class="submenu">
							<a href="InsertData.php" target="_blank" title="Insert">Insert</a>
						</li>
						<li class="submenu" id="logoset">
							<a href="index.php">
								<img id="logo" src="images/Sneaker_logo.svg"/> <br/> 
								<img id="sneaker" src="images/logo_name.png"/>
							</a>
						</li>
						<li class="submenu">
							<a href="UpdateData.php" title="Update">Update</a>
						</li>
						<li class="submenu">
							<a href="DeleteData.php" title="Delete">Delete</a>
						</li>
					</ul>
					
				</div>
      </div>



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

$sql = "SELECT * FROM sneakertoy";
$stmt = $pdo->prepare($sql);
//Thiết lập kiểu dữ liệu trả về
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();
echo '<p>Transaction information:</p>';
?>
<div class="back">
<div id="container">
<table class="table striped" width="100%" height="40%", border="1">
    <thead>
      <tr>
        <th>ToyID</th>
        <th>ToyName</th>
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
        <td scope="row"><?php echo $row['toyid'] ?></td>
        <td><?php echo $row['tname'] ?></td>
        <td><?php echo $row['unitprice'] ?></td>
        <td><?php echo $row['checkdate'] ?></td>
        
      </tr>
     
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
</div>
</body>
</html>
