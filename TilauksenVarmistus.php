<?php
$lista = $_POST["lista"];
$pizza = $_POST["pizza"];
$listaname = $_POST["toppingname"];
$pizzaname = $_POST["pizzaName"];


for ($i = 0; $i < count($pizza); $i++)
{
    echo $pizza[$i];
    echo "  ";
    foreach($lista[$i] as $item){
        echo $item;
        echo " <br /> ";
    }    
}
echo " <br /> ";
echo " <br /> ";
for ($i = 0; $i < count($pizzaname); $i++)
{
    echo $pizzaname[$i];
    echo "  ";
    foreach($listaname[$i] as $item){
        echo $item;
        echo " <br /> ";
    }    
}

?>
