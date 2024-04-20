<!-- /*

Clase 01 => 
Delgado Augusto =>

Aplicación No 5 (Números en letras)
Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.

*/ -->

<?php

$num = rand(20,60);
$numeroEnPalabra = null;
$strNum = "{$num}";
$resultado = $num % 10;


$primerArrayDeNumeros = array(1=>  "Uno",2=> "Dos",3=> "Tres",4=> "Cuatro",
5=> "Cinco",6=> "Seis",7=> "Siete",8=> "Ocho",9=> "Nueve");

$segundoArrayDeNumeros  =  array(20 => "Veinte" ,30 => "Treinta", 
40 => "Cuarenta", 50 => "Cincuenta",60 => "Sesenta");

if(is_float($resultado) == false)
{
    foreach($segundoArrayDeNumeros as $key => $value) 
    {
        if($num == $key)
        {
            $numeroEnPalabra = $value;
            break;
        }
    }
}



if($numeroEnPalabra == null)
{
    foreach($primerArrayDeNumeros as $key => $value) 
    {
        if($num == $key)
        {
            $numeroEnPalabra = $value;
            break;
        }
    }
}




echo "";

?>