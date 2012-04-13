<?php

require_once "tietokanta.php";

$yhteys = getTietokanta();

//if (empty($_POST["lista"])) {
//    echo "Et valinnut mitään tuotetta!";
//} else {
    $lista = $_POST["lista"];
    echo "<p>Valitsit seuraavat tuotteet:</p>";
    echo "<ul>";
    foreach ($lista as $tuote) {
        echo "<li>{$tuote}";
        $kysely = $yhteys->prepare("select * from Lisuke");
        $kysely->execute();

//        $tulokset = $kysely->fetchAll();
    }
//    echo "</ul>";
//}


?>
