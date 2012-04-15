<?php

require_once "tietokanta.php";

$yhteys = getTietokanta();

//if (empty($_POST["lista"])) {
//    echo "Et valinnut mitään tuotetta!";
//} else {
    $lista = $_POST["lista"];
    $maara = $_POST["maara"];
    
    echo "<p>Valitsit seuraavat tuotteet:</p>";
    //echo "<ul>";
    for($i=0; $i < count($lista); $i++)
    {
        if ($maara[$i] != NULL)
        {
            echo $lista[$i];
            echo "\t\t";
            echo $maara[$i];
            echo "<br \>";
        }
    }
    //foreach ($lista as $tuote) {
        
      // echo "<li>{$tuote}";
        $kysely = $yhteys->prepare("select * from Lisuke");
        $kysely->execute();

//        $tulokset = $kysely->fetchAll();
 //   }
//    echo "</ul>";
//}


?>
