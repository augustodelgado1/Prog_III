<!-- Aplicación No 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.  

Augusto Delgado
A332
-->

<?php

$colores = array("Rojo","Azul","Amarillo","Violeta");
$marca = array("Bic","Pelikan","Farber Castell");
$trazo = array("Rojo","Azul","Amarillo","Violeta");


for ($i = 0; $i < 3; $i++) {

    $lapicera = array( "color" => $colores[rand(0,count($colores)-1)] , 
    "marca" => $marca[rand(0,count($marca)-1)] , "trazo" => $trazo[rand(0,count($trazo)-1)] ,  
    "precio" => rand(500,2000) );

    echo"<br><br>Lapicera {$i}";
    foreach ($lapicera as $key => $value) {
        echo"<br><br>$key -> $value";
    }
    
}
?>