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
           
            
        </table>
        

    </body>
</html>