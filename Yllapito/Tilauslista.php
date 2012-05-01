<?php
require_once "OnkoKirjautunut.php";
onkoKirjautunut();
require_once "../tietokanta.php";

$yhteys = getTietokanta();

$deleteid = $_GET["deleteid"];

if($deleteid != NULL){
    $kysely3 = $yhteys->prepare("DELETE FROM Tilaus WHERE $deleteid = tilausnro");
    $kysely3->execute();
}

$kysely = $yhteys->prepare("select * from Tilaus");
$kysely->execute();

$tulokset = $kysely->fetchAll();



?>

<html>
    <head>
        <title>Tilauslista</title>
    </head>
    <body>
        <h1>Kaikki tilaukset</h1>
        <table>
            <tr>
                <td>Tilausnro</td>
                <td>Asiakasnro</td>
                <td>Toimitusaika</td>
                <td>Osoite</td>
                <td>Postinumero</td>
                <td>Kaupunki</td>
                <td>Peruutettu</td>
                <td>Suoritusaika</td>
                <td>Häiriö</td>
                <td>Myöhästymisale</td>
                <td>Kokonaishinta</td>
                
            </tr>
            <?php foreach ($tulokset as $tu): ?>

                <tr>
                    <td><?php echo $tu['tilausnro'] ?></td>
                    <td><?php echo $tu['asiakasnro'] ?></td>
                    <td><?php echo $tu['toimitusaika'] ?></td>
                    <td><?php echo $tu['osoite'] ?></td>
                    <td><?php echo $tu['postinumero'] ?></td>
                    <td><?php echo $tu['kaupunki'] ?></td>
                    <td><?php echo $tu['peruutus'] ?></td>
                    <td><?php echo $tu['suoritusaika'] ?></td>
                    <td><?php echo $tu['hairio'] ?></td>
                    <td><?php echo $tu['myohastymisale'] ?></td>
                    <td><?php echo $tu['kokonaishinta'] ?></td>
                    <td><a href="Tilauslista.php?deleteid=<?php echo $tu['tilausnro'] ?>">Poista</a></td>
                    
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        
        <a href="Etusivu.php">Etusivulle</a>
        

    </body>

</html>