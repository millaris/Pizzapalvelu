<?php

// yhteyden muodostus tietokantaan
function onkoKirjautunut() {

    session_start();
    if (!isset($_SESSION["kayttaja"])) {
        header("Location: Kirjautuminen.php");
        die();
    }
}
?>