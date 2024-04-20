<!-- 

Clase 01 - 
Delgado Augusto -

Aplicación No 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron.

-->

<?php

$suma = 0;
$unNumero = 1;

while ($unNumero < 999) {
    $unNumero++;
    $suma += $unNumero;
}

echo "<br> <br> <br> la suma de todo los numero es {$suma} y el ultimo numero es {$unNumero}";

?>