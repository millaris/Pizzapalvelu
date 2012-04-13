<?php
require_once "tietokanta.php";

$yhteys = getTietokanta();

$kysely = $yhteys->prepare("select * from tuote");
$kysely->execute();

$tulokset = $kysely->fetchAll();

$lista = array();

?>
<html>
    <head>
        <title>Menu</title>
    </head>
    <body>
        <h1>Menu</h1>
        <table>
            <tr>
                <td>Nimi</td>
                <td>Kuva</td>
                <td>Tekstikuvaus</td>
                <td>Tyyppi</td>
                <td>Valitse</td>
            </tr>
            <?php foreach ($tulokset as $tuote): ?>

                <tr>
                <form action="TilauksenLisukkeet.php" method="post">
                    <td><?php echo $tuote['nimi'] ?></td>
                    <td><?php echo $tuote['kuva'] ?></td>
                    <td><?php echo $tuote['tekstikuvaus'] ?></td>
                    <td><?php echo $tuote['tyyppi'] ?></td>
                    <td> <a href="TilauksenLisukkeet.php"></a><input type="checkbox" name="lista[]" value= "$tuote['tuoteid']"> </td>
                </form>
            </tr>
        <?php endforeach; ?>

    </table>


    <a href="TilauksenLisukkeet.php">Jatka</a>
</body>

</html>