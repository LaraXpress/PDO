<?php
include('dbCon.php');
if(isset($_GET['id'])){
	$id    = $_GET['id'];
	$sql   = "delete from user where id=:id";
	$query = $con->prepare($sql);
	$query->bindParam(':id', $id, PDO::PARAM_INT);
	$query->execute();
	echo "Data Deleted Successfully!";
}
?>