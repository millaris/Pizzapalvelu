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
        <title>Lisukkeiden lisäys ja muokkaus</title>
    </head>
    <body>
        <h1>Lisukkeiden lisäys ja muokkaus</h1>
        <table>
            <form action="Lisukelista.php" method="post">
            <input type="hidden" name="id" value="<?php echo $lisuke['lisukeid'] ?>" />
            <tr>
            <td><?php echo Nimi ?> </td> 
            <td> <input type="text" name="nimi" value="<?php echo $lisuke['nimi'] ?>" </td>
            </tr>
            <tr>
            <td><?php echo Hinta ?> </td>
            <td> <input type="double" name="hinta" value="<?php echo $lisuke['hinta'] ?>" </td>
            </tr>
            <tr>
            <td> <input type="submit" value="Tallenna" </td>
            </tr>
         </form>
        </table>
    </body>
</html>
