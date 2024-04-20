
<!-- // En testGarage.php, crear autos y un garage. 
Probar el buen funcionamiento de todos los métodos. -->


<?php

Require_once "Garage.php";

$garage = new Garage("Carito",9000);
$marcas = array("Toyota","Ford","Duna");
$colores =  array("Rojo","Azul","Amarillo","Violeta");
$lenMarcas = count($marcas)-1;
$lenColores = count($colores)-1;
$otroAuto = new Auto("Toyota","Rojo");

$garage->Add($otroAuto );

do{

    $unAuto = new Auto($marcas[rand(0,$lenMarcas)],$colores[rand(0,$lenColores)],rand(700,10000));
    
    if($garage->Add($unAuto) == false)
    {
        echo"<br>Este auto no se pudo aniadir<br>";
        var_dump($unAuto);
    }

}while($garage->getCantidadDeAutosGuardados() < 5);

echo"<br><br>Aniado un elemento repetido<br>";

var_dump($unAuto);

if($garage->Add($unAuto) == false)
{
    echo"<br>Este auto no se pudo aniadir<br>";
    
}


echo"<br><br>Compruebo si esta<br>";

var_dump($otroAuto);

if($garage->Equals($otroAuto ) == true)
{
    echo"<br>Este auto esta en la lista<br>";
    
}

echo"<br><br>Compruebo si esta<br>";

var_dump(null);

if($garage->Equals(null ) == false)
{
    echo"<br>Este auto no esta en la lista<br>";
}


echo"<br><br>Elimino uno<br>";
var_dump($otroAuto);

if($garage->Remove($otroAuto) == true)
{
    echo"<br><br>Se elimino el elemento <br>";
}


echo"<br><br>Elimino uno<br>";

var_dump(null);

if($garage->Remove(null ) == false)
{
    echo"<br><br>No Se Pudo eliminar el elemento <br>";
    
}




?>