<?php
if (isset($_GET["donnees"])) {
    // Récupérer la valeur du paramètre "donnees" dans l'URL
    $donnees = $_GET["donnees"];
    
    // Séparer la chaîne en un tableau avec le séparateur ";"
    $values = explode(";", $donnees);
    
    // Vérifier si le tableau contient bien 4 valeurs
    if (count($values) == 4) {
        // Assigner les valeurs aux variables correspondantes
        $temperature = $values[0];
        $humidite = $values[1];
        $pression = $values[2];
        $luminosite = $values[3];
                    
        // Afficher les valeurs
        echo "Température: $temperature<br/>";
        echo "Humidité: $humidite<br/>";
        echo "Pression: $pression<br/>";
        echo "Luminosité: $luminosite<br/>";
    } else {
        echo "Il n'y a pas 4 valeurs dans la chaîne.";
    }
} else {
    echo "Aucun donnée transmise.";
}

if (count($values) == 4){
    $db = new PDO('mysql:host=fdb1030.awardspace.net;dbname=4545884_bd', '4545884_bd', 'nhung.1612');
	$ladate = date("Y-m-d H:i:s");
	echo "La date actuelle de la mesure : ",$ladate,"<br/>";
	$sql = "INSERT INTO mesure(date,temperature,humidite,pression,luminosite) 
	VALUES ('$ladate',$temperature,$humidite,$pression,$luminosite)";
	$sth = $db->prepare($sql);
	$sth->execute();

	echo "<br/>Insertion effectuée!";

	$db = null;
}
  
?>