<?php

	$server = 'tcp:amr-server.database.windows.net,1433';
	$database = 'amr-db';
	$username = 'amr.admin@amr-server';
	$password = 'EIGHT_characters!!!';

	$dsn = "sqlsrv:server=$server ; Database=$database";
	
	try {
		$connection = new PDO($dsn, $username, $password);
		$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
	
		$statement = $connection->prepare("INSERT INTO sensor_data (ID, Value, Date, Status) VALUES (:id, :value, DATEADD(hour,8,GETUTCDATE()), :status)");
		
		$statement->bindParam(':id', $id);
		$statement->bindParam(':value', $value);
		$statement->bindParam(':status', $status);
		
		if(!empty($_GET["id"]) and !empty($_GET["value"]) and !empty($_GET["status"])) {		
			$id = $_GET['id'];
			$value = $_GET['value'];
			$status = $_GET['status'];
			$statement->execute();
			
			print "Success";
		}
		else {
			print "Failed";
		}	
	}
	catch (PDOException $e) {
		print "Error: " . $e->getMessage() . "<br/>";
		die();
	}
	
	$connection = null;
?>