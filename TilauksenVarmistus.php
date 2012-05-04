<?php
require_once "OnkoKirjautunut.php";
onkoKirjautunut();
require_once "tietokanta.php";

$yhteys = getTietokanta();

$lista = $_POST["lista"];
$pizza = $_POST["pizza"];
$pizzanimi = $_POST["pizzanimi"];
$hinta = $_POST["hinta"];
$lounas = $_POST["lounas"];
$kokonaishinta = 0;
$kokonaishintalounas = 0;
$kokonaispizzahinta = 0;
$kokonaispizzahintalounas = 0;
?>
<html>
    <head>
        <title>Menu</title>
    </head>
    <body>
        <table border="1">
            <tr>
                <td>
                    Tilauksesi:
                </td>
            </tr>
            <tr>
                <td>
                    Tuote:
                </td>
                <td>
                    Lisuke:
                </td>                
                <td>
                    Hinta:
                </td>
            </tr>
                <?php

                for ($i = 0; $i < count($pizza); $i++)
                {
                    echo "<tr><td colspan=2> $pizzanimi[$i]</td>";
                    echo "<td>$hinta[$i] / $lounas[$i]</td></tr>" ;

                    $kokonaispizzahinta +=$hinta[$i];
                    $kokonaispizzahintalounas +=$lounas[$i];

                    foreach($lista[$i] as $item)
                    {
                        $kysely1 = $yhteys->prepare("select nimi, hinta from Lisuke WHERE LisukeId = $item");
                        $kysely1->execute();

                        $lisukkeet = $kysely1->fetch();
                        echo "<tr><td>&nbsp</td>";
                        echo "<td> $lisukkeet[nimi] </td>";
                        echo "<td> $lisukkeet[hinta]</td></tr>";                        
                        
                        $kokonaispizzahinta +=$lisukkeet['hinta'];
                        $kokonaispizzahintalounas +=$lisukkeet['hinta'];
                        
                    }
                    
                    $kokonaispizzahinta = number_format($kokonaispizzahinta, 2);
                    $kokonaispizzahintalounas = number_format($kokonaispizzahintalounas, 2);
                    echo "<tr><td>&nbsp</td><td>&nbsp</td><td><b>$kokonaispizzahinta /  $kokonaispizzahintalounas</b></td></tr>";
                    $kokonaishinta += $kokonaispizzahinta;                    
                    $kokonaishintalounas += $kokonaispizzahintalounas;
                    $kokonaispizzahinta = 0;
                    $kokonaispizzahintalounas = 0;
                }
                ?>
            <tr>
                <td colspan="2">
                    Kokonaishinta
                </td>
                <td>
                    <b><?php $kokonaishinta = number_format($kokonaishinta, 2);
                    echo "$kokonaishinta €";?></b>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                   Kokonaishinta (jos lounas):
                </td>                
                <td>
                    <b><?php $kokonaishintalounas = number_format($kokonaishintalounas, 2);
                    echo "$kokonaishintalounas €";?></b>
                </td>
            </tr>
        </table>
        <br />
        <br />
        <?php
            $asiakasnro = $_SESSION["kayttaja"];
            $kysely2 = $yhteys->prepare("select * from Asiakas WHERE Asiakasnro = $asiakasnro");
            $kysely2->execute();

            $asiakas = $kysely2->fetch();
        ?>
        <form action ="TilausOK.php" method="post">
            <input type="hidden" name="kokonaishintalounas" value="<?php echo $kokonaishintalounas ?>">
            <input type="hidden" name="kokonaishinta" value="<?php echo $kokonaishinta ?>">
            
            <input type="hidden" name="hinta" value="<?php echo $hinta ?>">
            <input type="hidden" name="lounas" value="<?php echo $lounas ?>">
            <input type="hidden" name="asiakasnro" value="<?php echo $asiakasnro ?>">
        <table>
            <tr>
                <td colspan ="2">
                    Toimitusosoite:
                </td>
            </tr>
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
                <td><input type="text" name="osoite" value="<?php echo $asiakas['osoite']; ?>"</td>
            </tr>
            <tr>
                <td>Postinumero</td>
                <td><input type="text" name="postinumero" value="<?php echo $asiakas['postinumero']; ?>"</td>
            </tr>
            <tr>
                <td>Kaupunki</td>
                <td><input type="text" name="kaupunki" value="<?php echo $asiakas['kaupunki']; ?>"</td>
            </tr>
            <tr>
                <td>Päivämäärä</td>
                <td><input type="text" name="day" maxlength="2" size="2">-
                    <input type="text" name="month" maxlength="2" size="2">-
                    <input type="text" name="year" value="2012"  maxlength="4" size="4"></td>
            </tr>
            <tr>
                <td>Aika</td>
                <td><input type="text" name="hours" maxlength="2" size="2">-
                    <input type="text" name="minutes" maxlength="2" size="2"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="hidden" name="lista" value="<?php echo htmlentities(serialize($lista)); ?>">
                    <input type="hidden" name="pizza" value="<?php echo htmlentities(serialize($pizza)); ?>">
                    <input type="hidden" name="pizzanimi" value="<?php echo htmlentities(serialize($pizzanimi)); ?>">
                    <input type="submit" value ="Jatka"/>
                </td>
            </tr>
        </table>
        </form>

    </body>
</html>