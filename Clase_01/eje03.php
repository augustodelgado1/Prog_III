<!-- /*

Clase 01 - 
Delgado Augusto 

Aplicación No 3 (Obtener el valor del medio)
Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre
el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres
variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido. Ejemplo 1: $a
= 6; $b = 9; $c = 8; => se muestra 8.
Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”
*/ -->

<?php

$maximo;
$minimo;
$unNumero;
$strMensaje = "No hay valor del medio";
$valorDelMedio = -1;

for ($i = 0; $i < 3; $i++){

    $unNumero = rand(0,9);
    
    if($i == 0 || $unNumero > $maximo){
        $maximo = $unNumero;
    }

    if($i == 0 ||  $unNumero  < $minimo){
        $minimo = $unNumero ;
    }

    if( $unNumero  < $maximo &&  $unNumero  > $minimo){

        $valorDelMedio = $unNumero;
    }
}

if($valorDelMedio != -1)
{
    $strMensaje = "El valor de el medio es {$valorDelMedio}";
}


echo "<br> El mayor es {$maximo}  , el minimo es {$minimo} y $strMensaje";



?>