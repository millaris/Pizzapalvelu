<?php
require_once "tietokanta.php";

$yhteys = getTietokanta();
$id = $_GET["id"];

$lisuke = NULL;
if ($id != NULL)
{
$kysely = $yhteys->prepare("select * from lisuke where lisukeid = $id");
$kysely->execute();

$lisuke = $kysely->fetch();
}

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
            <form action="Lisukelista.php" method="post">
            <input type="hidden" name="id" value="<?php echo $lisuke['lisukeid'] ?>" />
            Nimi <input type="text" name="nimi" value="<?php echo $lisuke['nimi'] ?>" />
            Hinta<input type="double" name="hinta" value="<?php echo $lisuke['hinta'] ?>" />
            <input type="submit" value="Lisää" />
         </form>
    </body>
</html>
