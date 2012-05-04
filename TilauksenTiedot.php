<?php

require_once "OnkoKirjautunut.php";
onkoKirjautunut();
require_once "tietokanta.php";

$yhteys = getTietokanta();

$id = $_GET["id"];

if($id != NULL){
    $kysely3 = $yhteys->prepare("Select tt.tilatutID, tu.nimi as Nimi, li.nimi as Lisuke  from TilatutTuotteet tt 
            left join TuotteenLisukkeet tl on tt.tilatutID = tl.tilatutID 
            join Tuote tu on tu.tuoteid = tt.tuoteid
            left join Lisuke li on li.lisukeid = tl.lisukeid
            WHERE tt.tilausnro= $id
            order by tt.tilatutID");
    $kysely3->execute()
            ;
    $info = $kysely3->fetchAll();
    $lastTilatutId = 0;
    foreach ($info as $item){
        
        if ($item['tilatutid'] != $lastTilatutId)
        {
            echo "<br/>" .$item['nimi'] . " -- ";
        }
        
        echo $item['lisuke'];
        echo ' ';
        $lastTilatutId = $item['tilatutid'];
        
    }
    
    
}

?>
