<?php
$a = file_get_contents(__DIR__ . '/json_data/user_client.json');
$b = json_decode($a);

?>
<!DOCTYPE html>
<html>

<head>
	<title>ADMIN</title>
	<link rel="shortcut icon" href="img/favicon.png">
	<style type="text/css">
		.table1 {
			font-family: sans-serif;
			color: #444;
			border-collapse: collapse;
			width: 50%;
			border: 1px solid #f2f5f7;
		}

		.table1 tr th {
			background: #35A9DB;
			color: #fff;
			font-weight: normal;
		}

		.table1,
		th,
		td {
			padding: 8px 20px;
			text-align: center;
		}

		.table1 tr:hover {
			background-color: #f5f5f5;
		}

		.table1 tr:nth-child(even) {
			background-color: #f2f2f2;
		}
	</style>
	<!DOCTYPE html>
	<html>

	<head>

	</head>

<body>
	<h1>admins</h1>

	<table class="table1">
		<tr>
			<th>Userid</th>
			<th>Username</th>
			<th>Nama pertama</th>
			<th>Nama terakhir</th>
		</tr>
		<?php
		foreach ($b as $bfor) {
			echo '<tr>
						<td><a href="tg://user?id=' . $bfor->userid . '">' . $bfor->userid . '</td>
						<td>' . $bfor->username . '</td>
						<td>' . $bfor->firstname . '</td>
						<td>' . $bfor->lastname . '</td>
					</tr>';
		}
		?>
	</table>
</body>

</html>