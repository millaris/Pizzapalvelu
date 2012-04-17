<?php
require_once "tietokanta.php";
$yhteys = getTietokanta();
$deleteid = $_GET["deleteid"];

if($deleteid != NULL){
    $kysely3 = $yhteys->prepare("DELETE FROM Lisuke WHERE $deleteid = Lisukeid");
    $kysely3->execute();
}

if ($_POST["nimi"] != NULL) {
    if ($_POST["id"] != NULL) {


        $nimi = $_POST["nimi"];
        $hinta = $_POST["hinta"];
        $idd = $_POST["id"];

        $kysely2 = $yhteys->prepare("UPDATE Lisuke SET Nimi = ?, Hinta = ? WHERE Lisukeid = ? ");
        $kysely2->execute(array($nimi, $hinta, $idd));
        echo 'OK';
    } else {
        $kysely1 = $yhteys->prepare("INSERT INTO Lisuke (Nimi, Hinta) VALUES (?, ?)");

        $nimi = $_POST["nimi"];
        $hinta = $_POST["hinta"];
        $kysely1->execute(array($nimi, $hinta));

        echo 'OK';
    }
}


$kysely = $yhteys->prepare("select * from Lisuke");
$kysely->execute();

$tulokset = $kysely->fetchAll();


?>
<html>
    <head>
        <title>Lisukkeet</title>
    </head>
    <body>
        <h1>Lisukkeet</h1>
        <table>
            <tr>
                <td>Nimi</td>
                <td>Hinta</td>
            </tr>
<?php foreach ($tulokset as $lisuke): ?>

                <tr>
                    <td><?php echo $lisuke['nimi'] ?></td>
                    <td><?php echo $lisuke['hinta'] ?></td>
                    <td><a href="Lisuke.php?id=<?php echo $lisuke['lisukeid'] ?>">Muokkaa</a></td>
                    <td><a href="Lisukelista.php?deleteid=<?php echo $lisuke['lisukeid'] ?>">Poista</a></t>
                </tr>

<?php endforeach; ?>
        </table>
         <br>
        <a href ="Lisuke.php">Lisää lisuke</a>

    </body>

</html>