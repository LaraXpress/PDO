<?php
include('dbCon.php');
if(isset($_POST['update'])){
	$id     = $_GET['id'];
	$name   = $_POST['name'];
	$pphone = $_POST['phone'];
	$email  = $_POST['email'];
	$sql    = "update user set name=:name,phone=:phone,email=:email where id=:id";
	$query  = $con->prepare($sql);
	$query->bindParam(':name', $name, PDO::PARAM_STR);
	$query->bindParam(':phone',$phone,PDO::PARAM_INT);
	$query->bindParam(':email',$email,PDO::PARAM_STR);
	$query->bindParam(':id',   $id,   PDO::PARAM_STR);
	$query->execute();
	echo "Data Updated Successfully!";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PDO - UPDATE </title>
	</head>
	<body>
		<form method="post">	
		<?php
			$id    = $_GET['id'];
			$sql   = "select * from user where id=:id";
			$query = $con->prepare($sql);
			$query->bindParam(':id', $id, PDO::PARAM_STR);
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_OBJ);
			if($query->rowCount()>0){
			$id = 1;
			foreach ($result as $row ) { ?>
				Name  :<input type="text"  name="name"  value="<?php echo $row->name;?>"  required><br />
				Phone :<input type="text"  name="phone" value="<?php echo $row->phone;?>" required><br />
				Email :<input type="email" name="email" value="<?php echo $row->email;?>" required><br />
			<?php }} ?>
			<input type="submit" name="update" value="Update">
		</form>
	</body>
</html>
