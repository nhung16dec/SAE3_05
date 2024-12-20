<?php
// Réception des données: valeur "" mise si pas transmis
$liste=$_GET["liste"]; // à compléter

$tableaumesures=explode(";",$liste);
if (count($tableaumesures)==3) {
	$temp=$tableaumesures[0];
	$humid=$tableaumesures[1];
	$press=$tableaumesures[2];
}
else {
	echo "Rien de correct de transmis. Aucune requête d'insertion de donnée exécutée.";
}

// Si une donnée au moins a été reçue
if (is_numeric($temp) && is_numeric($humid) && is_numeric($press)){
	$hote="10.11.159.10";
	$nomBDD="iot_92303223"; // à compléter
	$login="admindbetu";
	$pwd="admindbetu";
	$db = new PDO("mysql:host=$hote;dbname=$nomBDD", $login, $pwd);
	
	// Se placer sur le fuseau horaire de la France pour enregistrer les heures
	date_default_timezone_set('Europe/Paris');  
	$ladate=date("Y-m-d H:i:s");
	
	$sql="INSERT INTO eval_iot(date,temp,humid,press) VALUES ('$ladate',$temp, $humid, $press)"; // à compléter
	echo "Requête d'insertion de données SQL exécutée: <br/>",$sql;
	$sth = $db->prepare($sql);
	$sth->execute();
}
else
  echo "Rien de correct de transmis. Aucune requête d'insertion de donnée exécutée.";
?>