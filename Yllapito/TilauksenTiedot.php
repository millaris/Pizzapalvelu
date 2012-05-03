<?php

require_once "OnkoKirjautunut.php";
onkoKirjautunut();
require_once "../tietokanta.php";

$yhteys = getTietokanta();

$id = $_GET["id"];

if($id != NULL){
    $kysely3 = $yhteys->prepare("Select * from TilatutTuotteet tt join TuotteenLisukkeet tl on tt.tilatutID = tl.tilatutID WHERE tt.tilausnro= $id");
    $kysely3->execute();
    
}
echo 'OK';
?>
