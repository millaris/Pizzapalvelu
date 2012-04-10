<?php
require_once "tietokanta.php";

$yhteys = getTietokanta();
$id = $_GET["id"];
$tuote = NULL;
if ($id != NULL)
{
$kysely = $yhteys->prepare("select * from tuote where tuoteid = $id");
$kysely->execute();

$tuote = $kysely->fetch();
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
            <form action="Asiakas.php" method="post">
            <input type="hidden" name="id" value="<?php echo $tuote['tuoteid'] ?>" />
            Nimi <input type="text" name="nimi" value="<?php echo $tuote['nimi'] ?>" />
            Kuva<input type="text" name="kuva" value="<?php echo $tuote['kuva'] ?>" />
            Tekstikuvaus<input type="text" name="tekstikuvaus" value="<?php echo $tuote['tekstikuvaus'] ?>" />
            Tyyppi<input type="text" name="tyyppi" value="<?php echo $tuote['tyyppi'] ?>" />
            <input type="submit" value="Lisää" />
         </form>
    </body>
</html>
