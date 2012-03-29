<?php

// yhteyden muodostus tietokantaan
function getTietokanta() {
    try {
        $yhteys = new PDO("pgsql:");
    } catch (PDOException $e) {
        die("VIRHE: " . $e->getMessage());
    }
    $yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $yhteys;
}
?>
