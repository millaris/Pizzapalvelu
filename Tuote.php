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
        <title>Tuotteiden lisäys ja muokkaus</title>
    </head>
    <body>
        <h1>Tuotteiden lisäys ja muokkaus</h1>
        <table>
            <form action="Tuotelista.php" method="post">
            <input type="hidden" name="id" value="<?php echo $tuote['tuoteid'] ?>" />
            <tr>
            <td><?php echo Nimi ?> </td> 
            <td> <input type="text" name="nimi" value="<?php echo $tuote['nimi'] ?>" </td>
            </tr>
            <tr>
            <td><?php echo Kuva ?> </td> 
           <td> <input type="text" name="kuva" value="<?php echo $tuote['kuva'] ?>" </td>
           </tr>
            <tr>
            <td><?php echo  Tekstikuvaus?> </td> 
           <td> <input type="text" name="tekstikuvaus" value="<?php echo $tuote['tekstikuvaus'] ?>" </td>
             </tr>
            <tr>
           <td><?php echo Tyyppi ?> </td> 
            <td> <input type="text" name="tyyppi" value="<?php echo $tuote['tyyppi'] ?>" </td>
            <tr>
           <td> <input type="submit" value="Tallenna" </td>
            </tr>
         </form>
            </table>
    </body>
</html>
