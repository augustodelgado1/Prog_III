
<!-- 
Aplicación No 15 (Potencias de números)
Mostrar por pantalla las primeras 4 potencias 
de los números del uno 1 al 4 (hacer una función que
las calcule invocando la función pow).

Augusto Delgado
 -->

<?php

$potencia;

for ($i = 1; $i <= 4; $i++) 
{
    for ($j = 1; $j <= 4; $j++) {

        $potencia = CalcularPotencia($i,$j);
        echo"<br>$i elevado a la $j es = $potencia";
    }
}

function CalcularPotencia($num , $exponente)
{
    
    return pow($num,$exponente);
}


?>

