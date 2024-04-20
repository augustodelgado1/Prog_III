<!-- /*
Aplicación No 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números
utilizando las estructuras while y foreach.

Augusto Delgado
A332

*/ -->

<?php

$numerosImpares = array();
$suma = 0;
$promedio = 0.0;
$mensaje = "";
$unNumeroImpar;
$len = 0;

    for($i = 0; count($numerosImpares) < 10; $i++)
    {
        $unNumeroImpar = rand(1,100);

        if($unNumeroImpar % 2 != 0)
        {
            array_push($numerosImpares, $unNumeroImpar);
        }
    }

$len = count($numerosImpares);

//Mostrar
echo "Los numeros del Array son<br>";
for ($i = 0; $i < $len; $i++) {

    echo "<br>[$i] = $numerosImpares[$i]";
   
}
$index = 0;
echo "<br><br>IMPRESION WHILE";
while($index < $len) 
{
    echo "<br>[$index] = $numerosImpares[$index]";
    $index++;
}


echo "<br><br>IMPRESION FOREACH";
    foreach ($numerosImpares as $unNumero) {
        echo "<br>{$unNumero}";
    }

?>