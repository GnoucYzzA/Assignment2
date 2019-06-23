<!DOCTYPE html>
<html>
<head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="style.css" />
<style>
li {
list-style: none;
}
</style>
</head>
<body>
<div> 
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
            <br/>

</div>
<h1>INSERT DATA TO DATABASE</h1>
<h2>Enter data into table</h2>
<ul>
    <form name="InsertData" action="InsertData.php" method="POST" >
<li>Toy ID:</li><li><input type="text" name="ToyID" /></li>
<li>Toy Name:</li><li><input type="text" name="ToyName" /></li>
<li>Price:</li><li><input type="text" name="Price" /></li>
<li>Date:</li><li><input type="text" name="Date" /></li>
<li><input type="submit" /></li>
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

if($pdo === false){
     echo "ERROR: Could not connect Database";
}

//Khởi tạo Prepared Statement
//$stmt = $pdo->prepare('INSERT INTO student (stuid, fname, email, classname) values (:id, :name, :email, :class)');

//$stmt->bindParam(':id','SV03');
//$stmt->bindParam(':name','Ho Hong Linh');
//$stmt->bindParam(':email', 'Linhhh@fpt.edu.vn');
//$stmt->bindParam(':class', 'GCD018');
//$stmt->execute();
//$sql = "INSERT INTO student(stuid, fname, email, classname) VALUES('SV02', 'Hong Thanh','thanhh@fpt.edu.vn','GCD018')";
$sql = "INSERT INTO sneakertoy(toyid, tname, unitprice, checkdate)"
        . " VALUES('$_POST[ToyID]','$_POST[ToyName]','$_POST[Price]','$_POST[Date]')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
 if (is_null($_POST[ToyID])) {
   echo "ToyID must be not null";
 }
 else
 {
    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }
 }
?>
</body>
</html>
