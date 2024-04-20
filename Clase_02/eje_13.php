
<!-- Aplicación No 13 (Invertir palabra)
Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
“Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán: 1 si la palabra
pertenece a algún elemento del listado.
0 en caso contrario. 

Augusto Delgado

-->

<?php

$strPalabras = "Parcial";
$mensaje;
$retorno = InvertirPalabra($strPalabras,100);

$mensaje = "<br> la palabra $strPalabras";

if($retorno == 1)
{
    $mensaje .= " se encuntra en la lista"; 
}else{
    $mensaje .= " no se encuentra en la lista";
}

echo $mensaje;

function InvertirPalabra($palabra,$max)
{
    $listadoDePalabra = array("Recuperatorio","Parcial" , "Programacion");
    $len  = strlen($palabra);
    $retorno = 0;

    if($len < $max && in_array($palabra,$listadoDePalabra) != false)
    {
        $retorno = 1;
    }

    return $retorno;
   
}

?>