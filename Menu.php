<?php
require_once "tietokanta.php";

$yhteys = getTietokanta();

$kysely = $yhteys->prepare("select * from tuote");
$kysely->execute();
$kysely2 = $yhteys->prepare("select * from lisuke");
$kysely2->execute();

$tulokset = $kysely->fetchAll();
$lisuke = $kysely2->fetchAll();
?>
<html>
    <head>
        <title>Menu</title>
    </head>
    <body BACKGROUND="pizza.jpg"

          <h3><FONT SIZE ="14" COLOR = "red"> Menu </FONT></h3>


        <table width ="80%">
            <tr>
                <td width="25%">Nimi</td>
                <td width="25%">Kuva</td>
                <td width="25%">Tekstikuvaus</td>
                <td width="25%">Tyyppi</td>

            </tr>
<?php foreach ($tulokset as $tuote): ?>

                <tr>

                    <td><?php echo $tuote['nimi'] ?></td>
                    <td><?php echo $tuote['kuva'] ?></td>
                    <td><?php echo $tuote['tekstikuvaus'] ?></td>
                    <td><?php echo $tuote['tyyppi'] ?></td>

                </tr>
<?php endforeach; ?>
 <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4"> <h2>Pizzojen lisukkeet: </h2></td>
            </tr>
            <tr>
<?php foreach ($lisuke as $tuote): ?>

                <tr>

                    <td><?php echo $tuote['nimi'] ?></td>
                    <td><?php echo $tuote['hinta'] ?></td>
                    <td colspan="2"></td>

<?php endforeach; ?>
            </tr>
            <tr>
                <td> <a href="Etusivu.php" >Etusivulle</a>  </td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td> <a href="Kirjautuminen.php" >Kirjaudu</a> </td>
                <td colspan="3"></td>
            </tr>


        </table>



    </body>

</html>