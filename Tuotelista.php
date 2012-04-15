<?php
require_once "tietokanta.php";

$yhteys = getTietokanta();

$deleteid = $_GET["deleteid"];

if($deleteid != NULL){
    $kysely3 = $yhteys->prepare("DELETE FROM Tuote WHERE $deleteid = Tuoteid");
    $kysely3->execute();
}

if ($_POST["nimi"] != NULL) {
    if ($_POST["id"] != NULL) {

        
        $nimi = $_POST["nimi"];
        $kuva = $_POST["kuva"];
        $tekstikuvaus = $_POST["tekstikuvaus"];
        $tyyppi = $_POST["tyyppi"];
        $idd = $_POST["id"];

        $kysely2 = $yhteys->prepare("UPDATE Tuote SET nimi = ?, kuva = ?, tekstikuvaus = ?, tyyppi = ? WHERE tuoteid = ? ");

        
        $kysely2->execute(array($nimi, $kuva, $tekstikuvaus, $tyyppi, $idd));

         echo 'OK';
    }
    else{


    $kysely1 = $yhteys->prepare("INSERT INTO Tuote (Nimi, Kuva, Tekstikuvaus, Tyyppi) VALUES (?, ?, ?, ?)");

    $nimi = $_POST["nimi"];
    $kuva = $_POST["kuva"];
    $tekstikuvaus = $_POST["tekstikuvaus"];
    $tyyppi = $_POST["tyyppi"];

    $kysely1->execute(array($nimi, $kuva, $tekstikuvaus, $tyyppi));

    }
}

$kysely = $yhteys->prepare("select * from tuote");
$kysely->execute();

$tulokset = $kysely->fetchAll();
?>
<html>
    <head>
        <title>Tuotteet</title>
    </head>
    <body>
        <h1>Tuotteet</h1>
        <table>
            <tr>
                <td>Nimi</td>
                <td>Kuva</td>
                <td>Tekstikuvaus</td>
                <td>Tyyppi</td>
            </tr>
            <?php foreach ($tulokset as $tuote): ?>

                <tr>
                    <td><?php echo $tuote['nimi'] ?></td>
                    <td><?php echo $tuote['kuva'] ?></td>
                    <td><?php echo $tuote['tekstikuvaus'] ?></td>
                    <td><?php echo $tuote['tyyppi'] ?></td>
                    <td><a href="Tuote.php?id=<?php echo $tuote['tuoteid'] ?>">Muokkaa</a></td>
                    <td><a href="Tuotelista.php?deleteid=<?php echo $tuote['tuoteid'] ?>">Poista</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <a href =" Tuote.php">Lisää tuote</a>

    </body>

</html>