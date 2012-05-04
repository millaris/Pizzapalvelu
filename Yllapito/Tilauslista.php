<?php
require_once "OnkoKirjautunut.php";
onkoKirjautunut();
require_once "../tietokanta.php";

$yhteys = getTietokanta();



$deleteid = $_GET["deleteid"];

if($deleteid != NULL){
    $kysely3 = $yhteys->prepare("DELETE FROM Tuotteenlisukkeet WHERE tilatutid in 
            (select tilatutid from tilatuttuotteet tt where $deleteid = tilausnro)");
    $kysely3->execute();
    $kysely3 = $yhteys->prepare("DELETE FROM TilatutTuotteet WHERE $deleteid = tilausnro");
    $kysely3->execute();
    $kysely3 = $yhteys->prepare("DELETE FROM Tilaus WHERE $deleteid = tilausnro");
    $kysely3->execute();
}

if ($_POST["id"] != NULL) {
    
        
        $day = $_POST["day"];
$month = $_POST["month"];
$year = $_POST["year"];
$hours = $_POST["hours"];
$minutes = $_POST["minutes"];

$date = date('d-m-Y H:i', mktime($hours, $minutes, 0, $month, $day, $year));


        $hairio = $_POST["hairio"];
        $myohastymisale = $_POST["myohastymisale"];
        $loytyiko = $_POST["loytyiko"];
        $idd = $_POST["id"];

        $kysely2 = $yhteys->prepare("UPDATE Tilaus SET suoritusaika = ?, hairio = ?, myohastymisale = ?, loytyiko = ? WHERE tilausnro = ? ");

        $kysely2->execute(array($date, $hairio, $myohastymisale, $loytyiko, $idd));

 
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
                <td> </td>
                
            </tr>
            <?php foreach ($tulokset as $tu): ?>

                <tr>
                    <td><a href="TilauksenTiedot.php?id=<?php echo $tu['tilausnro'] ?>"><?php echo $tu['tilausnro'] ?></a></td>
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
                    <td><?php echo $tu[''] ?></td>
                    <td><a href="Tilauslista.php?deleteid=<?php echo $tu['tilausnro'] ?>">Poista</a></td>
                    <td><a href="TilausToimitettu.php?id=<?php echo $tu['tilausnro'] ?>">Päivitä</a></td>
                    
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        
        <a href="Etusivu.php">Etusivulle</a>
        

    </body>

</html>