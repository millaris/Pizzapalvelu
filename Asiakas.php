<?php

require_once "tietokanta.php";

$yhteys = getTietokanta();
$kysely = $yhteys->prepare("INSERT INTO Asiakas (Asiakasnro, Nimi, Puhelin, Mustalista) VALUES (?, ?, ?, ?)");
$kysely->execute(array(1201, "Matti Meikalainen", "0501234567", 0));

$kysely->execute(array(1202, "Maija Muukalainen", "0401234567", 0));

echo 'OK';


?>