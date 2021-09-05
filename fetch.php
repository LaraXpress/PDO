<?php

// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','pdo');

// Establish database connection.
try{
	$con = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
}
catch (PDOException $e){
	exit("Error: " . $e->getMessage());
}

// Fetch Data from Databasse [While Loop Mechanism]
$sql   = "select * from user";
$query = $con->prepare($sql);
$query->execute();
while($row= $query->fetch(PDO::FETCH_ASSOC)){
	echo $row['name'].'<br/>';
}

// Fetch Data from Databasse [Foreach Loop Mechanism] 
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
</tr>
<?php $id++; } } ?>     	

<!-- Fetch Data from Databasse [While Loop Mechanism]  -->
<?php 
$sql   = "select * from users";
$query = $con->prepare($sql);
$query->execute();		    	    		    		   
while($row = $query->fetch(PDO::FETCH_ASSOC)){
	$name     = $row['name'];
	$username = $row['username'];
	$email    = $row['email']; ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<p><?= $name; ?></p>
			<p><?= $username; ?></p>
			<p><?= $email; ?></p>
		</div>
	</div>
</div>
<?php } ?>	
 
<!-- FETCH DATA FROM DATABASE WITHOUT LOOP -->
<?php 
    if(isset($_GET['post_id'])){
        $id    = $_GET['post_id'];
        $sql   = "select * from posts where post_id = :id";
        $query = $con->prepare($sql);
        $query->execute([':id'=>$id]);                                                    
        $row   = $query->fetch(PDO::FETCH_ASSOC);
        $post_title    = $row['post_title'];
        $post_category = $row['post_category'];
        $post_detail   = $row['post_details'];
        $post_date     = $row['post_date'];
    }
?> 
