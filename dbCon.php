<?php 
	// DB credentials.
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','');
	define('DB_NAME','');
	// Establish database connection.
	try{
		$con = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
	}
	catch (PDOException $e){
		exit("Error: " . $e->getMessage());
	}
?>
			<!-- ANOTHER WAY CONNECTION WITH DATABASE -->
<?php 
	try 
	{
		$hostname = 'localhost';
		$username = 'root';
		$password = '';
		$dbname   = 'pdoa';
		$con      = new PDO("mysql:host=$hostname; dbname=$dbname", $username, $password);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) 
	{
		$e->getMessage();
		//die('Sorry!, Database is not connected properly ...!');	
	}
?>