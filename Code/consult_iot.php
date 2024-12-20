<?php
	$hote="10.11.159.10";
	$nomBDD="iot_92303223"; // à compléter
	$login="admindbetu";
	$pwd="admindbetu";
	$db = new PDO("mysql:host=$hote;dbname=$nomBDD", $login, $pwd);

	$sql="SELECT * FROM eval_iot"; // à compléter
	$sth = $db->prepare($sql);
	$sth->execute();
?>

<h1>Contenu de la table :</h1>
<table cellspacing='0' cellpadding='0' border='1'>
<tr><th>id</th><th>date</th><th>temp</th><th>humid</th><th>press</th></tr>
	
<?php
	while ($ligne=$sth->fetch(PDO::FETCH_ASSOC)){
		echo "<tr><td>",$ligne["id"],"</td><td>",$ligne["date"],"</td><td>",$ligne["temp"],"</td>
		<td>",$ligne["humid"],"</td><td>",$ligne["press"],"</td></tr>\n";
	}
?>

</table>