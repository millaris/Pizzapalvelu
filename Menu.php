<?php
require_once "tietokanta.php";

$yhteys = getTietokanta();

$kysely = $yhteys->prepare("select * from tuote");
$kysely->execute();

$tulokset = $kysely->fetchAll();


?>
<html>
    <head>
        <title>Menu</title>
    </head>
    <body>
        <h1>Menu</h1>
        
        <form action="TilauksenLisukkeet.php" method="post">
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
                
                    <td><?php echo $tuote['nimi'] ?></td>
                    <td><?php echo $tuote['kuva'] ?></td>
                    <td><?php echo $tuote['tekstikuvaus'] ?></td>
                    <td><?php echo $tuote['tyyppi'] ?></td>
                    <td><input type="hidden" name="lista[]" value= "<?php echo $tuote['tuoteid']?>">
                        <input type="text" name="maara[]">
                    </td>
              
            </tr>
        <?php endforeach; ?>

    </table>
            <input type ="submit" value ="Jatka">
              </form>


</body>

</html>