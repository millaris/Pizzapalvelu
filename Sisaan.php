<?php

require_once "tietokanta.php";

session_start();

echo 'OK';

$asiakas = $_POST["asiakasnro"];
$numero = $_POST["puhelin"];

echo 'OK';

$yhteys = getTietokanta();
$kysely = $yhteys->prepare("select * from Asiakas WHERE asiakasnro = '$asiakas' and puhelin= '$numero'");
$kysely->execute();
$tulokset = $kysely->fetch();

echo 'OK';

if($tulokset =! NULL){
    $_SESSION["kayttaja"] = $asiakasnro;
        header("Location: Etusivu.php");
        die();
}


?>
<p>Tunnus tai salasana on väärin!</p>
<p><a href="Kirjautuminen.html">Takaisin</a></p>