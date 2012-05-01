<?php
require_once "tietokanta.php";

$yhteys = getTietokanta();

$kysely = $yhteys->prepare("select t.*, h.hinta as lounashinta, hh.hinta from tuote t join hinta h on h.tuoteid = t.tuoteid and h.onkolounas = true
join hinta hh on hh.tuoteid = t.tuoteid and hh.onkolounas = false");
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
    <body BACKGROUND="pizza3(1).jpg"

          <h3><FONT SIZE ="14" COLOR = "red"> Menu </FONT></h3>


        <table width ="80%">
            <tr>
            
                <td width="15%"><h3>Nimi</h3></td> 
                <td width="10%"><h3>Kuva</h3></td>
                <td width="25%"><h3>Tekstikuvaus</h3></td>
                <td width="15%"><h3>Tyyppi</h3></td>
                <td width="17.5%"><h3>Normaali hinta</h3></td>
                <td width="17.5%"><h3>Lounashinta</h3></td>
           

            </tr>
<?php foreach ($tulokset as $tuote): ?>

                <tr>

                    <td><?php echo $tuote['nimi'] ?></td>
                    <td><?php echo $tuote['kuva'] ?></td>
                    <td><?php echo $tuote['tekstikuvaus'] ?></td>
                    <td><?php echo $tuote['tyyppi'] ?></td>
                    <td><?php echo $tuote['hinta'] ?></td>
                    <td><?php echo $tuote['lounashinta'] ?></td>

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
             <td colspan="4">&nbsp;</td>
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