<?php
require_once "OnkoKirjautunut.php";
onkoKirjautunut();
require_once "tietokanta.php";

$yhteys = getTietokanta();

$lista = unserialize($_POST["lista"]);
$pizza = unserialize($_POST["pizza"]);

$hinta = $_POST["hinta"];
$lounas = $_POST["lounas"];
$osoite = $_POST["osoite"];
$postinumero = $_POST["postinumero"];
$kaupunki = $_POST["kaupunki"];
$day = $_POST["day"];
$month = $_POST["month"];
$year = $_POST["year"];
$hours = $_POST["hours"];
$minutes = $_POST["minutes"];
$kokonaishintalounas = $_POST["kokonaishintalounas"];
$kokonaishinta = $_POST["kokonaishinta"];
$asiakasnro = $_POST["asiakasnro"];
$tilausnro;
$tilatutid;
$hinta;

 // luodaan päivämäärä- ja aikamuuttuja  
$date = date('d-m-Y H:i', mktime($hours, $minutes, 0, $month, $day, $year));

// tarkistetaan tunnit
if ($hours < 15 && $hours > 10)
{
// lounastarjous
    $hinta = $kokonaishintalounas;
}
else
{
//normaali hinta
    $hinta = $kokonaishinta;
}

$kysely = $yhteys->prepare("insert into Tilaus (asiakasnro, toimitusaika, osoite, postinumero, kaupunki, kokonaishinta) VALUES (?, ?, ?, ?, ?, ?) returning tilausnro ");
$kysely->execute(array($asiakasnro, $date, $osoite, $postinumero, $kaupunki, $hinta));
$tilausnro = $kysely->fetch();

$tilausnro = $tilausnro[0];

for ($i = 0; $i < count($pizza); $i++)
{   
    $kysely = $yhteys->prepare("insert into tilatuttuotteet ( tilausnro, tuoteid) VALUES (?, ?) returning tilatutid ");
    $kysely->execute(array($tilausnro, $pizza[$i]));
    $tilatutid = $kysely->fetch();
    $tilatutid = $tilatutid[0];
    
    foreach($lista[$i] as $item)
    {
        $kysely = $yhteys->prepare("insert into tuotteenlisukkeet (lisukeid, tilatutid) VALUES (?, ?)");
        $kysely->execute(array($item, $tilatutid));              
    }
}

echo "Kiitos tilauksestasi!"

?>
<p>
<a href="Etusivu.php">Palaa etusivulle</a></p>
