<?php
require_once "OnkoKirjautunut.php";
onkoKirjautunut();

require_once "tietokanta.php";

$yhteys = getTietokanta();

            $asiakasnro = $_SESSION["kayttaja"];
            $kysely2 = $yhteys->prepare("select * from Asiakas WHERE Asiakasnro = $asiakasnro");
            $kysely2->execute();

            $asiakas = $kysely2->fetch();
        ?>
<html>
    <body>
        <table>
            <tr>
                <td>Nimi</td>
                <td><?php echo $asiakas['nimi']; ?></td>
            </tr>
            <tr>
                <td>Puhelin</td>
                <td><?php echo $asiakas['puhelin']; ?></td>
            </tr>
            <tr>
                <td>Osoite</td>
                <td><?php echo $asiakas['osoite']; ?></td>
            </tr>
            <tr>
                <td>Postinumero</td>
                <td><?php echo $asiakas['postinumero']; ?></td>
            </tr>
            <tr>
                <td>Kaupunki</td>
                <td><?php echo $asiakas['kaupunki']; ?></td>
            </tr>
           
            
        </table>
        

    </body>
</html>
<?php
$kysely = $yhteys->prepare("select Tilausnro, Toimitusaika, osoite, postinumero, kaupunki, kokonaishinta
    from Tilaus
    where Asiakasnro =$asiakasnro");
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
                <td>Toimitusaika</td>
                <td>Osoite</td>
                <td>Postinumero</td>
                <td>Kaupunki</td>
                <td>Kokonaishinta</td>
                
            </tr>
            <?php foreach ($tulokset as $tu): ?>

                <tr>
                    <td><a href="TilauksenTiedot.php?id=<?php echo $tu['tilausnro'] ?>"><?php echo $tu['tilausnro'] ?></a></td>
                  
                    <td><?php echo $tu['toimitusaika'] ?></td>
                    <td><?php echo $tu['osoite'] ?></td>
                    <td><?php echo $tu['postinumero'] ?></td>
                    <td><?php echo $tu['kaupunki'] ?></td>
                    <td><?php echo $tu['kokonaishinta'] ?></td>
                    <?php 
                    $date = $tu['toimitusaika'];
                    $date->add(new DateInterval('H1'));
                    if($date > getdate()){
                    ?>
                    
                        <td><a href="TilauksenTiedot.php?id=$tu['tilausnro']">peruuta tilaus </a></td>;
                    <?php
                    }
                   ?>
                   
                    
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        
        <a href="Etusivu.php">Etusivulle</a>
        

    </body>

</html>