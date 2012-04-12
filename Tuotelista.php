<?php
require_once "tietokanta.php";

$yhteys = getTietokanta();

if ($_POST["nimi"] != NULL) {
    if ($_POST["id"] != NULL) {

        
        $nimi = $_POST["nimi"];
        $kuva = $_POST["kuva"];
        $tekstikuvaus = $_POST["tekstikuvaus"];
        $tyyppi = $_POST["tyyppi"];
        $idd = $_POST["id"];

        $kysely2 = $yhteys->prepare("UPDATE Tuote SET Nimi = ?, Kuva = ?, Tekstikuvaus = ?, Tyyppi = ? WHERE Tuoteid = ? ");

        
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

    echo 'OK';
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
                    <td><a href="Tuote.php?id=<?php echo $tuote['tuoteid'] ?>">edit</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

    </body>

</html>