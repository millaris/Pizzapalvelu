<?php

require_once "tietokanta.php";

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
            </tr>
            <?php foreach ($tulokset as $tu): ?>

                <tr>
                    <td><?php echo $tu['asiakasnro'] ?></td>
                    <td><?php echo $tu['nimi'] ?></td>
                    <td><?php echo $tu['puhelin'] ?></td>
                    <td><?php echo $tu['mustalista'] ?></td>
                    <td><a href="Asiakaslista.php?deleteid=<?php echo $tu['asiakasnro'] ?>">Poista</a></td>
                    
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        

    </body>

</html>