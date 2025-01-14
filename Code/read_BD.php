<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title></title>

	</head>
	<body>
		<?php
		$db = new PDO('mysql:host=fdb1030.awardspace.net;dbname=4545884_bd', '4545884_bd', 'nhung.1612');
		$sql = "SELECT * FROM mesure
        ORDER BY date DESC";
		$sth = $db->prepare($sql);
		$sth->execute();
		echo "<table border='1' cellspacing='0'>\n";
		echo "
		<tr>
		<th>ID</th>
		<th>Date</th>
		<th>Température</th>
		<th>Humidité</th>
		<th>Pression</th>
        <th>Luminosité</th>
		</tr>\n";
		while($ligne=$sth->fetch(PDO::FETCH_ASSOC))
			echo "
			<tr>
			<td>",$ligne["id_mesure"],"</td>
			<td>",$ligne["date"],"</td>
			<td>",$ligne["temperature"],"</td>
			<td>",$ligne["humidite"],"</td>
			<td>",$ligne["pression"],"</td>
			<td>",$ligne["luminosite"],"</td>
			</tr>\n";

		echo "</table>\n";
		$db = null;
		  
		?>
	</body>
</html>