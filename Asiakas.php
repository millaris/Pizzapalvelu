<?php

require_once "tietokanta.php";

$yhteys = getTietokanta();


$kysely = $yhteys->prepare("INSERT INTO Asiakas (Nimi, Puhelin, Mustalista, Osoite, Postinumero, Kaupunki) VALUES (?, ?, ?, ?, ?, ?) returning asiakasnro");



$nimi = $_POST["nimi"];
$puhelin = $_POST["puhelinnumero"];
$osoite = $_POST["osoite"];
$postinro = $_POST["postinumero"];
$kaupunki = $_POST["kaupunki"];

$id = $_POST["id"];

$kysely->execute(array($nimi, $puhelin, 0, $osoite, $postinro, $kaupunki));
$asiakasnro = $kysely->fetch();

echo 'Kiitos rekisteröitymisestä. Tietosi on tallennettu. Asiakasnumerosi on ';
echo $asiakasnro[0];
echo '. Voit kirjautua sisään antamalla asiakasnumerosi ja puhelinnumerosi.'
?>
        <p><a href="Etusivu.php">Etusivulle</a> </p>
         <p><a href="Kirjautuminen.php">Kirjaudu sisään</a></p>
