<!-- Aplicación No 25 (Contar letras)
Se quiere realizar una aplicación que lea un archivo (../misArchivos/palabras.txt) y ofrezca
estadísticas sobre cuantas palabras de 1, 2, 3, 4 y más de 4 letras hay en el texto. No tener en
cuenta los espacios en blanco ni saltos de líneas como palabras.
Los resultados mostrarlos en una tabla. -->

<?php

require_once "./Palabra.php";

// $archi = fopen("archi.txt","w");

// if(!fwrite($archi,"Hola soy la la la,jaja jaa jaa j j j a"))
// {
//     echo"No se pudo escribir el archivo<br>";
// }

// fclose($archi);



// PHP_EOL;

$unArray = [];
$archi = fopen("archi.txt","r");


    do
    {
        $unaLinea = fgets($archi);
        $palabras = explode(' ', $unaLinea);
    }while(!feof($archi));



    for ($i= 1; $i <= 4; $i++)
    {
        $unArray = ObtenerArrayPalabrasPorCantidad($palabras,$i);

        if(isset($unArray))
        {
            echo"La cantidad de palabras de $i letras que hay es ".count($unArray)."<br>";
        }
    }
    
function ObtenerArrayPalabrasPorCantidad($unArray,$cantidad)
{
    $result = null;

    if($cantidad > 0)
    {
        $result = [];
        foreach ($unArray as $unaPalabra)
        {
            if(strlen($unaPalabra) == $cantidad)
            {
                array_push($result, $unaPalabra);
            }
        }
    }

    return $result;
} 
?>