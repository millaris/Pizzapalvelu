<?php

require_once "tietokanta.php";

$yhteys = getTietokanta();
$kysely = $yhteys->prepare("INSERT INTO Asiakas (Nimi, Puhelin, Mustalista) VALUES (?, ?, ?)");



$nimi = $_POST["nimi"];
$puhelin = $_POST["puhelinnumero"];

$kysely->execute(array($nimi, $puhelin, 0));


echo 'OK';


?>