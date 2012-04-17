<?php


$lista = $_POST["lista"];
echo $lista;
//echo $lista[0][0];

//for ($i = 0; $i < count($lista); $i++) {
//    echo $lista[$i];

foreach ($lista as $item){
    echo $item[0];
}
?>
