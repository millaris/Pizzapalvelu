<?php
require_once "OnkoKirjautunut.php";
onkoKirjautunut();
require_once "../tietokanta.php";

$yhteys = getTietokanta();
$id = $_GET["id"];

if ($id != NULL) {
    $kysely = $yhteys->prepare("select * from Tilaus
where tilausnro = $id");
    $kysely->execute();

    $tuote = $kysely->fetch();
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Tilauksen päivitys</title>
    </head>
    <body>
        <h1>Tilauksen päivitys</h1>
        <table>
            <form action="Tilauslista.php" method="post">
                <input type="hidden" name="id" value="<?php echo $tuote['tilausnro'] ?>" />
                 <tr>
                <td>Suorituspäivämäärä</td>
                <td><input type="text" name="day" maxlength="2" size="2">-
                    <input type="text" name="month" maxlength="2" size="2">-
                    <input type="text" name="year" value="2012"  maxlength="4" size="4"></td>
            </tr>
            <tr>
                <td>Suoritusaika</td>
                <td><input type="text" name="hours" maxlength="2" size="2">-
                    <input type="text" name="minutes" maxlength="2" size="2"></td>
            </tr>
                <tr>
                    <td><?php echo Häiriö ?> </td> 
                    <td> <select name="hairio">
                            <option value="false"> Ei
                                <option value="true"> Kyllä
                                </td>
                </tr>
                <tr>
                    <td><?php echo Myöhästymisalennus ?> </td> 
                    <td> <input type="text" name="myohastymisale" value="<?php echo $tuote['myohastymisale'] ?>" </td>
                </tr>
             
                <tr>
                    <td><?php echo Löytyikö ?> </td> 
                    <td> <select name="loytyiko">
                            <option value="true"> Kyllä
                            <option value="false"> Ei
                                </td>
                </tr>

                            <tr>
                                <td> <input type="submit" value="Tallenna" </td>
                            </tr>
            </form>
        </table>
    </body>
</html>
