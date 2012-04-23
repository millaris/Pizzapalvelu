<?php

session_start();


if($_SESSION["kayttajatunus"] != NULL){

unset($_SESSION["kayttajatunus"]);
session_destroy();
}



header( "Location: Etusivu.php" );

?>
