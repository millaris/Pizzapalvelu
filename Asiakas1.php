<?php

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <table
            <tr>
        <form action="Asiakas.php" method="post">
                <td>Nimi</td>
                <td>Puhelinnumero</td>
                <td>Osoite</td>
                <td>Postinumero</td>
                <td>Kaupunki</td>
        </tr>
        <tr>
            <td><input type="text" name="nimi" /></td>
            <td><input type="integer" name="puhelinnumero" /> </td>
            <td><input type="text" name="osoite" /> </td>
            <td><input type="integer" name="postinumero" /> </td>
            <td><input type="text" name="kaupunki" /> </td>
        </tr>
        <tr>
            <input type="hidden" name="id" />
            <td><input type="submit" value="Tallenna" /> </td>
        </tr>
         </form>
        </table>
    </body>
</html>
