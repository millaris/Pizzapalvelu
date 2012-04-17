<?php

require_once "tietokanta.php";

$yhteys = getTietokanta();


$kysely = $yhteys->prepare("INSERT INTO Asiakas (Nimi, Puhelin, Mustalista) VALUES (?, ?, ?) returning asiakasnro");



$nimi = $_POST["nimi"];
$puhelin = $_POST["puhelinnumero"];

$id = $_POST["id"];

$kysely->execute(array($nimi, $puhelin, 0));
$asiakasnro = $kysely->fetch();

echo 'Kiitos rekisteröitymisestä. Tietosi on tallennettu. Asiakasnumerosi on ';
echo $asiakasnro[0];
echo 'Voit kirjautua sisään antamalla asiakasnumerosi ja puhlinnumerosi.'
?>
        <p><a href="Etusivu.php">Etusivulle</a> </p>
         <p><a href="Asiakas1.php">Kirjaudu sisään</a></p>
