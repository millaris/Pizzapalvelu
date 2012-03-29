<?php

require_once "tietokanta.php";

$yhteys = getTietokanta();
$kysely = $yhteys->prepare("select * from testi");
$kysely->execute();

$tulokset = $kysely->fetchAll();
?>
<html>
    <head>
        <title>Koesivu</title>
    </head>
    <body>
        <h1>Tuloksia</h1>
        <table>
            <tr>
                <td>Id</td>
                <td>Nimi</td>
            </tr>
            <?php foreach($tulokset as $tulos): ?>
            
            <tr>
                <td><?php echo $tulos['id'] ?></td>
                <td><?php echo $tulos['nimi'] ?></td>
            </tr>
            <?php  endforeach; ?>
        </table>
        
    </body>
    
</html>