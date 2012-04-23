<?php

session_start();

if($_SESSION["kayttaja"] != NULL){

unset($_SESSION["kayttaja"]);
session_destroy();

}
header( "Location: Etusivu.php" );

?>
