<?php
require_once "tietokanta.php";

$yhteys = getTietokanta();

$kysely1 = $yhteys->prepare("select Nimi from Lisuke");
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
            for ($i = 0; $i < count($lista); $i++) {
                if ($maara[$i] != NULL && $maara[$i] != 0) {

                    $kysely = $yhteys->prepare("select Nimi from Tuote WHERE Tuoteid = $lista[$i]");
                    $kysely->execute();
                    $tuotteennimi = $kysely->fetch();

                    for ($j = 0; $j < $maara[$i]; $j++) {
                        ?>
                        <tr>
                            <td colspan="2"><h3><?php echo $tuotteennimi['nimi'] ?></h3></td>
                        </tr>
                        <?php 
                        $luku = 0;
                        foreach ($lisukkeet as $lisu): 
                        $luku++
                            ?>

                            <tr>
                                <td> <?php echo $lisu['nimi'] ?> </td>    
                                <td> <input type="checkbox" name="lista[<?php echo $i ?>][]" value="<?php echo $luku ?>"> </td>

                            </tr>


                        <?php
                        endforeach;
                    }
                }
            }
           
            ?>
                            
        </table>
            <input type="submit" value ="Jatka"/>

        </form>
    </body>

</html>

