<?php

require_once "tietokanta.php";
$yhteys = getTietokanta();
// kyselyn suoritus
$kysely = $yhteys->prepare("INSERT INTO testi (id, nimi) VALUES (?, ?)");
$kysely->execute(array(13, "Toinen kala"));

$kysely->execute(array(14, "Toinen kala"));

echo 'OK';


?>