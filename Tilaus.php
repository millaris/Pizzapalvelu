<?php
require_once "OnkoKirjautunut.php";
onkoKirjautunut();

require_once "tietokanta.php";

$yhteys = getTietokanta();

$kysely = $yhteys->prepare("select t.*, h.hinta as lounashinta, hh.hinta from tuote t join hinta h on h.tuoteid = t.tuoteid and h.onkolounas = true
join hinta hh on hh.tuoteid = t.tuoteid and hh.onkolounas = false");
$kysely->execute();

$tulokset = $kysely->fetchAll();


?>
<html>
    <head>
        <title>Menu</title>
    </head>
    <body BACKGROUND="pizza3(1).jpg"
        
        <h1><FONT SIZE = "20 "COLOR = "red"> Menu <FONT></h1>
        
        <form action="TilauksenLisukkeet.php" method="post">
        <table>
            <tr>
                <td width="15%"><h3>Nimi</h3></td> 
                <td width="10%"><h3>Kuva</h3></td>
                <td width="25%"><h3>Tekstikuvaus</h3></td>
                <td width="15%"><h3>Tyyppi</h3></td>
                <td width="15%"><h3>Normaali hinta</h3></td>
                <td width="15%"><h3>Lounashinta</h3></td>
                <td width="5%"><h3>Valitse</h3></td>
            </tr>
            <?php foreach ($tulokset as $tuote): ?>

                <tr>
                
                    <td><?php echo $tuote['nimi'] ?></td>
                    <td><?php echo $tuote['kuva'] ?></td>
                    <td><?php echo $tuote['tekstikuvaus'] ?></td>
                    <td><?php echo $tuote['tyyppi'] ?></td>
                    <td><?php echo $tuote['hinta'] ?></td>
                    <td><?php echo $tuote['lounashinta'] ?></td>
                    <td><input type="hidden" name="lista[]" value= "<?php echo $tuote['tuoteid']?>">
                        <select name="maara[]">
                            <option value="0"> 0
                            <option value="1"> 1
                            <option value="2"> 2
                            <option value="3"> 3
                            <option value="4"> 4
                            <option value="5"> 5
                            <option value="6"> 6
                            <option value="7"> 7
                            <option value="8"> 8
                            <option value="9"> 9
                            <option value="10"> 10
                    </td>
                    
                    
              
            </tr>
        <?php endforeach; ?>

    </table>
            <input type ="submit" value ="Jatka">
              </form>


</body>

</html>