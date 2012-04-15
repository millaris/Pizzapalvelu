<?php

require_once "tietokanta.php";

$yhteys = getTietokanta();


$kysely = $yhteys->prepare("INSERT INTO Asiakas (Nimi, Puhelin, Mustalista) VALUES (?, ?, ?)");



$nimi = $_POST["nimi"];
$puhelin = $_POST["puhelinnumero"];

$id = $_POST["id"];

$kysely->execute(array($nimi, $puhelin, 0));

echo 'Kiitos rekisteröitymisestä. Tietosi on tallennettu. Asiakasnumerosi on';
echo $id['id']


?>