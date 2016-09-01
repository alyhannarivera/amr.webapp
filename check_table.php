<?php

	$server = 'tcp:amr-server.database.windows.net,1433';
	$database = 'amr-db';
	$username = 'amr.admin@amr-server';
	$password = 'EIGHT_characters!!!';
	
	$dsn = "sqlsrv:server=$server ; Database=$database";
	
	try {
		$connection = new PDO($dsn, $username, $password);
		$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		
		$statement = "SELECT 1 FROM sensor_data";
		$result = $connection->query($statement);	

		print "Table exists: ";
			
		$statement = "SELECT * FROM sensor_data ORDER by Date DESC";
		$result = $connection->query($statement);
			
		$id_data = $result->fetchALL();	
		if(count($id_data) > 0) {
			
			print "sensor_data";
			print "<table>";
			print "<tr><th>ID</th>";
			print "<th>Consumption</th>";
			print "<th>Date</th>";
			print "<th>Status</th></tr>";
			foreach($id_data as $id_data) {
				print "<tr><td>" . $id_data['ID'] . "</td>";
				print "<td>" . $id_data['Value'] . "</td>";
				print "<td>" . $id_data['Date'] . "</td>";
				print "<td>" . $id_data['Status'] . "</td></tr>";
			}
			print "</table>";
		}
		else {
			print "No data available.";
		}								
	}
	catch(PDOException $e) {
		print "Error: " . $e->getMessage() . "<br/>";
		die();
	}
	
	$connection = null;
?>