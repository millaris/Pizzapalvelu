<?php
require_once "OnkoKirjautunut.php";
onkoKirjautunut();

$lista = $_POST["lista"];
$pizza = $_POST["pizza"];
$pizzanimi = $_POST["pizzanimi"];
$hinta = $_POST["hinta"];
$lounas = $_POST["lounas"];
$kokonaishinta = 0;
$kokonaishintalounas = 0;
require_once "tietokanta.php";

$yhteys = getTietokanta();





for ($i = 0; $i < count($pizza); $i++)
{
    echo "----";
    echo $pizzanimi[$i];
    echo " - ";
    echo $hinta[$i];
    $kokonaishinta +=$hinta[$i];
    $kokonaishintalounas +=$lounas[$i];
    echo " - ";
    echo $lounas[$i];
    echo " <br /> ";
    foreach($lista[$i] as $item){
        $kysely1 = $yhteys->prepare("select nimi, hinta from Lisuke WHERE LisukeId = $item");
        $kysely1->execute();

        $lisukkeet = $kysely1->fetch();
        echo $lisukkeet['nimi'];
        echo " - ";
        echo $lisukkeet['hinta'];
        $kokonaishinta +=$lisukkeet['hinta'];
        $kokonaishintalounas +=$lisukkeet['hinta'];
        echo " <br /> ";
    }    
}
echo " <br /> ";
echo " <br /> ";

$asiakasnro = $_SESSION["kayttaja"];
$kysely2 = $yhteys->prepare("select * from Asiakas WHERE Asiakasnro = $asiakasnro");
$kysely2->execute();

$asiakas = $kysely2->fetch();

echo $asiakas['nimi'];
echo " <br /> ";
echo $asiakas['puhelin'];
echo " <br /> ";
echo $asiakas['osoite'];
echo " <br /> ";
echo $asiakas['postinumero'];
echo " <br /> ";
echo $asiakas['kaupunki'];
echo " <br /> ";
echo "Kokonaishinta: $kokonaishinta €";
echo " <br /> ";
echo "Kokonaishinta (jos lounas): $kokonaishintalounas €";

?>
