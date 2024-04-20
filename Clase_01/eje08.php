<!-- /*
Aplicación No 8 (Carga aleatoria)
Imprima los valores del vector asociativo siguiente usando la estructura de control foreach:
$v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';

Augusto Delgado
A332

*/ -->

<?php

$v[1]=90; $v[30]=7; $v['e']=99; $v["hola"]= "mundo";

//Mostrar
foreach($v as $key => $value) 
{
    echo "<br>[$key] = $value";
}


?>