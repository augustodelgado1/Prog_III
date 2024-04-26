
<!-- // En testGarage.php, crear autos y un garage. 
Probar el buen funcionamiento de todos los métodos. -->


<?php

Require_once "Garage.php";

$garage = new Garage("Carito",9000);

$unAuto = new Auto("Toyota","Rojo");
$garage->Add($unAuto);
$garage->Add(new Auto("Toyota","Marron"));

//  Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
$garage->Add(new Auto ("Toyota","Gris",700));

$otroAuto = new Auto("Toyota","Amarillo");

$garage->Add($otroAuto );

echo $garage->MostrarGarage();

echo"<br><br>Aniado un elemento repetido<br>";

var_dump($unAuto);

if(!$garage->Add($unAuto))
{
    echo"<br>Este auto no se pudo aniadir<br>";
}


echo"<br><br>Compruebo si esta<br>";

var_dump($otroAuto);

if($garage->Equals($otroAuto ))
{
    echo"<br>Este auto esta en la lista<br>";
    
}

echo"<br><br>Compruebo si esta<br>";
$otroAuto = new Auto("Ford","Violeta");
var_dump($otroAuto);

if(!$garage->Equals($otroAuto))
{
    echo"<br>Este auto no esta en la lista<br><br>;";
}


echo"<br><br>Elimino el primer elemento uno<br>";
var_dump($unAuto);

if($garage->Remove($unAuto))
{
    echo"<br><br>Se elimino el elemento y Asi quedo la lista <br>".$garage->MostrarGarage()."<br>";

   
}


echo"<br><br>Elimino uno<br>";

var_dump($otroAuto );

if(!$garage->Remove($otroAuto))
{
    echo"<br><br>No Se Pudo eliminar el elemento <br>";
}




?>