<html>
	<head>
		<Title>Login</Title>
			<style type="text/css">
				body { background-color: #fff; border-top: solid 10px #000;
					color: #333; font-size: .85em; margin: 20; padding: 20;
					font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
				}
				h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
				h1 { font-size: 2em; }
				h2 { font-size: 1.75em; }
				h3 { font-size: 1.2em; }
				table { margin-top: 0.75em; }
				th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
				td { padding: 0.50em 2em 0.25em 0em; border: 0 none; }
			</style>
	</head>
	<body>
		<h1>This is a protosite..</h1>
		<p>Fill in your ID, then click <strong>Submit</strong></p>
		<form method="post" action="login.php" enctype="multipart/form-data" >
			ID:   <input type="text" name="id" id="id"/></br></br>
		<input type="submit" name="submit" value="Submit"/>
		</form>
	
	<?php
		
		$server = 'tcp:amr-server.database.windows.net,1433';
		$database = 'amr-db';
		$username = 'amr.admin@amr-server';
		$password = 'EIGHT_characters!!!';
		
		$dsn = "sqlsrv:server=$server ; Database=$database";
		
		try {
			$connection = new PDO($dsn, $username, $password);
			$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			
			if(!empty($_POST)) {
				$id = $_POST['id'];
				
				$statement = "SELECT Value, Date, Status FROM sensor_data WHERE ID = '" . $id . "' ORDER BY Date DESC";
				$result = $connection->query($statement);
			
				$id_data = $result->fetchALL();
				if(count($id_data) > 0) {

					print "Welcome!";
					print "<table>";
					print "<tr><th>Consumption</th>";
					print "<th>Date</th>";
					print "<th>Status</th></tr>";
					
					print "<tr><td>(cubic meters)</td>";
					print "<td>(YYYY:MM:DD:HH:MM:SS)</td>";
					print "<td>(activity)</td></tr>";
					
					foreach($id_data as $id_data) {
						print "<tr><td>" . $id_data['Value'] . "</td>";
						print "<td>" . $id_data['Date'] . "</td>";
						print "<td>" . $id_data['Status'] . "</td></tr>";
					}
					print "</table>";
				}
				else {
					print "No data available.";
				}
			}
			else {
				print "<h3> Please input an ID. </h3>";
			}
			
			$statement = "SELECT * FROM sensor_data";
			$result = $connection->query($statement);
			
		}
		catch(PDOException $e) {
			print "Error: " . $e->getMessage() . "<br/>";
			die();
		}	
	?>	
	
	</body>
</html>