<!-- /*
Aplicación No 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.

Augusto Delgado
A332
*/ -->

<?php

$vec = array();
$suma = 0;
$promedio = 0.0;
$mensaje = "";

for ($i = 0; $i < 5; $i++) {

    $vec[$i] = rand(0,10);
}

for ($i = 0; $i < 5; $i++) {

    $suma += $vec[$i];
}

$promedio =  $suma / count($vec); 


echo "Los numeros del Array son";
var_dump($vec);

if ($promedio  > 6) {
    $mensaje = "El promedio es mayor que 6.\n";
} else 
{
    if ($promedio  < 6) {
        $mensaje = "El promedio es menor que 6.\n";
    }else {
        $mensaje = "El promedio es igual a 6.\n";
    }
}

echo "<br> $mensaje ";
?>