<?php
	include('dbCon.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PDO - READ</title>
	</head>
	<body>
		<table>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Phone</th>
				<th>Email</th>		
				<th>Action</th>
			</tr>
		<?php
			$sql   = "select * from user";
			$query = $con->prepare($sql);
			$query->execute();
		    $result = $query->fetchAll(PDO::FETCH_OBJ);
			if($query->rowCount()>0){
			$id = 1;
			foreach($result as $row ) { ?>
			<tr>
				<th><?php echo $id; ?></th>
				<th><?php echo $row->name;  ?></th>
				<th><?php echo $row->phone; ?></th>
				<th><?php echo $row->email; ?></th>				
				<th><a href="update.php?id=<?php echo $row->id?>">Update</a></th>
				<th><a href="delete.php?id=<?php echo $row->id?>">Delete</a></th>
			</tr>
		<?php $id++; } } ?>
		</table>
	</body>
</html>