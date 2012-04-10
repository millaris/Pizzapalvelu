<?php
require_once "tietokanta.php";

$yhteys = getTietokanta();
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
            <?php foreach($tulokset as $tuote): ?>
            
            <tr>
                <td><?php echo $tuote['nimi'] ?></td>
                <td><?php echo $tuote['kuva'] ?></td>
                <td><?php echo $tuote['tekstikuvaus'] ?></td>
                <td><?php echo $tuote['tyyppi'] ?></td>
                <td><a href="Tuote.php?id=<?php echo $tuote['tuoteid'] ?>">edit</a></td>
            </tr>
            <?php  endforeach; ?>
        </table>
        
    </body>
    
</html>