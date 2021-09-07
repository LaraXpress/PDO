<?php
	// Transaction Workflow Process in PDO	
	try 
	{
		$hostname = 'localhost';
		$username = 'root';
		$password = '';
		$dbname   = 'pdo';
		$con      = new PDO("mysql:host=$hostname; dbname=$dbname", $username, $password);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
		$con->beginTransaction();
		$con->query("insert into posts(post_title, post_details) values('PHP','This is post for HTML')");	
		$con->query("insert into posts(post_title, post_details) values('C#','This is post for CSS')");	
		$con->query("insert into posts(post_title, post_details) values('JAVA','This is post for JS')");	
		$con->query("insert into posts(post_title, post_details) values('Python','This is post for JQ'')");	
		$con->query("insert into posts(post_title, post_details) values('ASP.NET','This is post for BOOTSTRAP')");	
		$con->query("insert into posts(post_title, post_details) values('MERN','This is post for MYSQL')");	
		$con->commit();
	}
	catch(PDOException $e) 
	{
		$con->rollback();
		echo $e->getMessage();		
	}

