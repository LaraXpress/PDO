<?php

$dsn = "mysql:host=localhost; dbname=techbarik";
try{
	$con = new PDO($dsn, 'root', '');
}catch(PDOException $e){
	echo $e->getMessage();
}
