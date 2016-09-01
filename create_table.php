<?php

	$server = 'tcp:amr-server.database.windows.net,1433';
	$database = 'amr-db';
	$username = 'amr.admin@amr-server';
	$password = 'EIGHT_characters!!!';
	
	$dsn = "sqlsrv:server=$server ; Database=$database";
	
	try {
		$connection = new PDO($dsn, $username, $password);
		$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$statement = 
		"CREATE TABLE sensor_data(
		ID VARCHAR(5) NOT NULL,
		Value DECIMAL(10,2) NOT NULL,
		Date SMALLDATETIME NOT NULL,
		Status VARCHAR(8) NOT NULL)";
		
		$connection->exec($statement);	
		
	}
	catch(PDOException $e) {
		print "Error: " . $e->getMessage() . "<br/>";
		die();
	}
	
	$connection = null;
	
	print "Successfully created a table." . "<br/>";	
?>