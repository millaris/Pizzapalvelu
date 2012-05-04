<?php

session_start();

$kayttajatunus = $_POST["kayttajatunus"];
$salasana = $_POST["salasana"];

if($kayttajatunus == "admin12" && $salasana == "admin21"){
    $_SESSION["kayttajatunus"] = $kayttajatunus;
        header("Location: Etusivu.php");
        die();
}

?>
<p>Tunnus tai salasana on väärin!</p>
<p><a href="Kirjaudu.php">Takaisin</a></p>