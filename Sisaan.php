<?php

require_once "tietokanta.php";

session_start();


$asiakas = $_POST["asiakasnro"];
$numero = $_POST["puhelin"];



$yhteys = getTietokanta();
$kysely = $yhteys->prepare("select * from Asiakas WHERE asiakasnro = '$asiakas' and puhelin= '$numero'");
$kysely->execute();
$tulokset = $kysely->fetch();


if($tulokset != NULL){
    $_SESSION["kayttaja"] = $asiakas;
        header("Location: Etusivu.php");
        die();
}


?>
<p>Tunnus tai salasana on väärin!</p>
<p><a href="Kirjautuminen.php">Takaisin</a></p>