<?php
session_start();

$salasanat = array();
$salasanat["aapeli"] = "kissa";
$salasanat["maija"] = "pupu";

$tunnus = $_POST["tunnus"];
$salasana = $_POST["salasana"];

if (isset($salasanat[$tunnus])) {
    if ($salasanat[$tunnus] == $salasana) {
        $_SESSION["kayttaja"] = $tunnus;
        header("Location: sisalto.php");
        die();
    }
}
?>
<p>Tunnus tai salasana on väärin!</p>
<p><a href="kirjautuminen.html">Takaisin</a></p>