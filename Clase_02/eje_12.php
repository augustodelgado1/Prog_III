<!-- Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres 
y que invierta el orden de las
letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.

Augusto Delgado
 -->


<?php

$strPalabras = "Hola";

$retorno = InvertirPalabra($strPalabras);

echo"<br>la palabra es la $strPalabras y invertida es  $retorno";

function InvertirPalabra($strPalabras)
{
    $arrayDeletras = null;
    $len  = strlen($strPalabras)-1;
    for ($i = $len; $i >= 0; $i--)
    {
        $arrayDeletras .= $strPalabras[$i];
    }

    return $arrayDeletras;
   
}


?>