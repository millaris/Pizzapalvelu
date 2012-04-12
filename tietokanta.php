<?php

// yhteyden muodostus tietokantaan
function getTietokanta() {
    try {
        $yhteys = new PDO("pgsql:host=localhost;dbname=millaris",
                      "millaris", "f2a79ec4094b298c");
    } catch (PDOException $e) {
        die("VIRHE: " . $e->getMessage());
    }
    $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $yhteys;
}
?>
