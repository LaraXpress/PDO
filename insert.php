<?php
include('dbCon.php');
if(isset($_POST['save'])){
	$name    = $_POST['name'];
	$phone   = $_POST['phone'];
	$email   = $_POST['email'];
	$sql     = "insert into users(name,phone,email) value(:name,:phone,:email)";
	$query   = $con->prepare($sql);
	$query->bindParam(':name',  $name,  PDO::PARAM_STR);
	$query->bindParam(':phone', $phone, PDO::PARAM_INT);
	$query->bindParam(':email', $email, PDO::PARAM_STR);
	$query->execute();
	$result = $con->lastInsertId();
	if($result){
		echo "Data Inserted Successfully!";
	}else{
		echo "Sorry, Data Failed to Save...";
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>PDO - INSERT </title>
	</head>
	<body>
		<form method="post">			
			Name  :<input type="text"   name="name"  required><br />
			Phone :<input type="text"   name="phone" required><br />
			Email :<input type="email"  name="email" required><br />
				   <input type="submit" name="save"  value="Submit">
		</form>
	</body>
</html>
