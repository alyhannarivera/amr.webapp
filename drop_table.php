<?php

	$server = 'tcp:amr-server.database.windows.net,1433';
	$database = 'amr-db';
	$username = 'amr.admin@amr-server';
	$password = 'EIGHT_characters!!!';
	
	$dsn = "sqlsrv:server=$server ; Database=$database";
	
	try {
		$connection = new PDO($dsn, $username, $password);
		$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		$statement = "DROP TABLE sensor_data";
		
		$connection->exec($statement);	
			
	}
	catch(PDOException $e) {
		print "Error: " . $e->getMessage() . "<br/>";
		die();
	}
	
	$connection = null;
	
	print "Successfully dropped a table." . "<br/>";
?>