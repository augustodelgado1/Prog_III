
<!-- Aplicación No 25 (Contar letras)
Se quiere realizar una aplicación que lea un archivo (../misArchivos/palabras.txt) y ofrezca
estadísticas sobre cuantas palabras de 1, 2, 3, 4 y más de 4 letras hay en el texto. No tener en
cuenta los espacios en blanco ni saltos de líneas como palabras.
Los resultados mostrarlos en una tabla. -->
<?php

class Palabra
{
    static function ObtenerArrayDePalabras($texto,$caracteres)
    {
        $listadePalabras = [];
        $unaPalabra = null;
        $len = strlen($texto);

        foreach($caracteres as $unCaracter)
        {

            $unaPalabra .= $unCaracter;

            if(in_array($unCaracter, $listadePalabras))
            {
            array_push($listadePalabras, $unCaracter);
            }

        }

        return $listadePalabras;
    } 


}





?>