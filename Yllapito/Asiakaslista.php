<?php
require_once "OnkoKirjautunut.php";
onkoKirjautunut();
require_once "../tietokanta.php";

$yhteys = getTietokanta();

$deleteid = $_GET["deleteid"];

if($deleteid != NULL){
    $kysely3 = $yhteys->prepare("DELETE FROM Asiakas WHERE $deleteid = Asiakasnro");
    $kysely3->execute();
}

$kysely = $yhteys->prepare("select * from asiakas");
$kysely->execute();

$tulokset = $kysely->fetchAll();



?>

<html>
    <head>
        <title>Rekisteröityneet asiakkaat</title>
    </head>
    <body>
        <h1>Rekisteröityneet asiakkaat</h1>
        <table>
            <tr>
                <td>Asiakasnro</td>
                <td>Nimi</td>
                <td>Puhelinnro</td>
                <td>Mustalista</td>
                <td>Osoite</td>
                <td>Postinumero</td>
                <td>Kaupunki</td>
            </tr>
            <?php foreach ($tulokset as $tu): ?>

                <tr>
                    <td><?php echo $tu['asiakasnro'] ?></td>
                    <td><?php echo $tu['nimi'] ?></td>
                    <td><?php echo $tu['puhelin'] ?></td>
                    <td><?php if ($tu['mustalista']) echo 'Joo'; else echo 'Ei'; ?></td>
                    <td><?php echo $tu['osoite'] ?></td>
                    <td><?php echo $tu['postinumero'] ?></td>
                    <td><?php echo $tu['kaupunki'] ?></td>
                    <td><a href="Asiakaslista.php?deleteid=<?php echo $tu['asiakasnro'] ?>">Poista</a></td>
                    
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        
        <a href="Etusivu.php">Etusivulle</a>
        

    </body>

</html>