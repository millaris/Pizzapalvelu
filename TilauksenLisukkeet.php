<?php

require_once "OnkoKirjautunut.php";
onkoKirjautunut();

require_once "tietokanta.php";

$yhteys = getTietokanta();

$kysely1 = $yhteys->prepare("select lisukeid, nimi from Lisuke");
$kysely1->execute();

$lisukkeet = $kysely1->fetchAll();

$lista = $_POST["lista"];
$maara = $_POST["maara"];
?>
<html>
    <head>
        <title>Menu</title>
    </head>
    <body>
        <p>Valitse pizzoihisi lisukkeet:</p>
        <form action ="TilauksenVarmistus.php" method="post">

            <table>

                <?php
                $luku = 0;
                for ($i = 0; $i < count($lista); $i++) {
                    if ($maara[$i] != NULL && $maara[$i] != 0) {

                        $kysely = $yhteys->prepare("select Nimi, tyyppi, h.hinta as lounashinta, hh.hinta from tuote t 
                                join hinta h on h.tuoteid = t.tuoteid and h.onkolounas = true 
                                join hinta hh on hh.tuoteid = t.tuoteid and hh.onkolounas = false 
                                WHERE t.Tuoteid = $lista[$i]");
                        $kysely->execute();
                        $tuotteennimi = $kysely->fetch();


                        for ($j = 0; $j < $maara[$i]; $j++) {
                            ?>
                            <tr>
                            <input type="hidden" name="pizza[<?php echo $luku ?>]" value="<?php echo $lista[$i] ?>">
                            <input type="hidden" name="pizzanimi[<?php echo $luku ?>]" value="<?php echo $tuotteennimi['nimi'] ?>">
                            <input type="hidden" name="hinta[<?php echo $luku ?>]" value="<?php echo $tuotteennimi['hinta'] ?>">
                            <input type="hidden" name="lounas[<?php echo $luku ?>]" value="<?php echo $tuotteennimi['lounashinta'] ?>">

                            <?php if ($tuotteennimi['tyyppi'] == 'pizza') { ?>
                                <td colspan="2"><h3><?php echo $tuotteennimi['nimi'] ?></h3></td>
                                </tr>
                                <?php
                                foreach ($lisukkeet as $lisu):
                                    ?>

                                    <tr>
                                        <td> <?php echo $lisu['nimi'] ?> </td>  
                                   
                                    <td> <input type="checkbox" name="lista[<?php echo $luku ?>][]" value="<?php echo $lisu['lisukeid'] ?>"> </td>

                                    </tr>


                                    <?php
                                endforeach;
                            }
                            $luku++;
                        }
                    }
                }
                ?>

            </table>
            <input type="submit" value ="Jatka"/>

        </form>
    </body>

</html>

