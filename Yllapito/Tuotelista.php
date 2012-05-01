<?php
require_once "OnkoKirjautunut.php";
onkoKirjautunut();
require_once "../tietokanta.php";

$yhteys = getTietokanta();

$deleteid = $_GET["deleteid"];

if ($deleteid != NULL) {
    $kysely3 = $yhteys->prepare("DELETE FROM Hinta WHERE $deleteid = Tuoteid");
    $kysely3->execute();
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
        $hinta = $_POST["hinta"];
        $lounas = $_POST["lounashinta"];

        $kysely2 = $yhteys->prepare("UPDATE Tuote SET nimi = ?, kuva = ?, tekstikuvaus = ?, tyyppi = ? WHERE tuoteid = ? ");

        $kysely2->execute(array($nimi, $kuva, $tekstikuvaus, $tyyppi, $idd));

        $kysely2 = $yhteys->prepare("UPDATE Hinta SET hinta = ?  WHERE tuoteid = ? and OnkoLounas = false");
        $kysely2->execute(array($hinta, $idd));

        $kysely2 = $yhteys->prepare("UPDATE Hinta SET hinta = ?  WHERE tuoteid = ? and OnkoLounas = true");
        $kysely2->execute(array($lounas, $idd));
    } else {


        $kysely1 = $yhteys->prepare("INSERT INTO Tuote (Nimi, Kuva, Tekstikuvaus, Tyyppi) VALUES (?, ?, ?, ?) returning tuoteid");

        $nimi = $_POST["nimi"];
        $kuva = $_POST["kuva"];
        $tekstikuvaus = $_POST["tekstikuvaus"];
        $tyyppi = $_POST["tyyppi"];
        $hinta = $_POST["hinta"];
        $lounas = $_POST["lounashinta"];

        $kysely1->execute(array($nimi, $kuva, $tekstikuvaus, $tyyppi));

        $kysely1 = $yhteys->prepare("INSERT INTO Hinta (TuoteId, OnkoLounas, Hinta) VALUES (lastval(), false, ?)");
        $kysely1->execute(array($hinta));

        $kysely1 = $yhteys->prepare("INSERT INTO Hinta (TuoteId, OnkoLounas, Hinta) VALUES (lastval(), true, ?)");
        $kysely1->execute(array($lounas));
    }
}

$kysely = $yhteys->prepare("select t.*, h.hinta as lounashinta, hh.hinta from tuote t join hinta h on h.tuoteid = t.tuoteid and h.onkolounas = true
join hinta hh on hh.tuoteid = t.tuoteid and hh.onkolounas = false");
$kysely->execute();

$tulokset = $kysely->fetchAll();
?>
<html>
    <head>
        <title>Tuotteet</title>
    </head>
    <body>
        <h1>Tuotteet</h1>
        <table width ="80%">
            <tr>
                <td width="20%"><h3>Nimi</h3></td>
                <td width="20%"><h3>Kuva</h3></td>
                <td width="20%"><h3>Tekstikuvaus</h3></td>
                <td width="20%"><h3>Tyyppi</h3></td>
                <td width="10%"><h3>Normaali hinta</h3></td>
                <td width="10%"><h3>Lounashinta</h3></td>
            </tr>
<?php foreach ($tulokset as $tuote): ?>

                <tr>
                    <td><?php echo $tuote['nimi'] ?></td>
                    <td><?php echo $tuote['kuva'] ?></td>
                    <td><?php echo $tuote['tekstikuvaus'] ?></td>
                    <td><?php echo $tuote['tyyppi'] ?></td>
                    <td><?php echo $tuote['hinta'] ?></td>
                    <td><?php echo $tuote['lounashinta'] ?></td>
                    <td><a href="Tuote.php?id=<?php echo $tuote['tuoteid'] ?>">Muokkaa</a></td>
                    <td><a href="Tuotelista.php?deleteid=<?php echo $tuote['tuoteid'] ?>">Poista</a></td>

                </tr>
<?php endforeach; ?>
        </table>
        <br>
        <a href =" Tuote.php">Lisää tuote</a>
        <a href ="Etusivu.php">Etusivulle</a>

    </body>

</html>