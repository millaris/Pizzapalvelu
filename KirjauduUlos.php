<?php

session_start();

if($_SESSION["kayttaja"] != NULL){

unset($_SESSION["kayttaja"]);
session_destroy();
header( "Location: KirjauduitUlos.php" );
die();
}
echo 'Et ollut kirjautunut sisään';


?>
<p> </p>
<a href="Etusivu.php">Etusivulle</a>