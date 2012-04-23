<?php


function onkoKirjautunut() {

    session_start();
    if (!isset($_SESSION["kayttajatunus"])) {
        header("Location: Kirjaudu.php");
        die();
    }
}
?>