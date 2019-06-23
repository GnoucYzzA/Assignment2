<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<style>
body{
  background-color: #8EC5FC;
background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);
}
</style>
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
                    <br>

</div>
        </div>

                        <ul align="center" margin-right: 9.5%>
                            <form name="UpdateData" action="UpdateData.php" method="POST" >
                                <p>Toy ID:</p><input type="text" name="ToyID" /><br/>
                                <p>Toy Name:</p><input type="text" name="ToyName" /><br/>
                                <p>Price:</p><input type="text" name="Price" /><br/>
                                <p>Date:</p><input type="text" name="Date" /><br/>
                                <li><button type="submit" class="btn btn-primary">Update</button></li>
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


$sql = "UPDATE sneakertoy SET tname = '$_POST[ToyName]', unitprice = '$_POST[Price]', checkdate = '$_POST[Date]' WHERE toyid = '$_POST[ToyID]'";
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
