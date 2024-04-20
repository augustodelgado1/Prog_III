<!-- 
Aplicación No 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.

Augusto Delgado
A332
-->


<?php

$colores = array("Rojo","Azul","Amarillo","Violeta");
$marca = array("Bic","Pelikan","Farber Castell");
$trazo = array("Rojo","Azul","Amarillo","Violeta");
$cartuchera = array();

for ($i = 0; $i < 3; $i++) {

    $cartuchera[] = $lapicera = array( "color" => $colores[rand(0,count($colores)-1)] , 
    "marca" => $marca[rand(0,count($marca)-1)] , "trazo" => $trazo[rand(0,count($trazo)-1)] ,  
    "precio" => rand(500,2000) );    
}

// var_dump($cartuchera);


//Mostrar
for ($i = 0; $i < 3; $i++) {

    echo"<br>Lapicera {$i}";
    foreach ($cartuchera[$i] as $key => $value) {
        echo"<br><br>$key -> $value";
    }
}

?>