
<!-- Aplicación No 20 (Auto - Garage)
Crear la clase Garage que posea como atributos privados:

_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)
Realizar un constructor capaz de poder instanciar objetos pasándole como

parámetros: i. La razón social.
ii. La razón social, y el precio por hora.


Crear un método de clase para poder hacer el alta de un Garage y, guardando los datos en un archivo
garages.csv.
Hacer los métodos necesarios en la clase Garage para poder leer el listado desde el archivo
garage.csv
Se deben cargar los datos en un array de garage.
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
métodos.
-->

<!-- 

Alumno : Augusto Delgado 
Div : A332
-->



<?php

Require_once "Garage.php";
$marca = array("Toyota","Ford","Wodswagen");
$colores = array("Marron","Rojo","Amarillo");
$listaDeGarage = array(new Garage("Carito",9000),new Garage("Jorgito",300),
                      new Garage("mauro",400));
$nombreDeArchivo = "garage.csv";



    foreach($listaDeGarage as $unGarage) 
    {
        for($i = 0; $i < 5; $i++)
        {
            $unGarage->Add(new Auto($marca[rand(0,count($marca)-1)],$colores[rand(0,count($colores)-1)]));
        }
    }

    echo "Lista de garages<br>";
    foreach($listaDeGarage as $unGarage) 
    {
        echo $unGarage->MostrarGarage();
    }
    
    // var_dump(implode(",",array("hola","bebe")));

    echo "<br><br><br> Guardo el archivo <br><br><br> ";
    if(Garage::EscribirArrayDeGarage($listaDeGarage,$nombreDeArchivo))
    {
        echo "El archivo se guardo correctamente";
    }else{
        echo "Hubo Error al guardar el archivo";
    }


    echo "<br><br>Leo el archivo <br><br> ";

    $listaDeGarage  = Garage::LeerArchivoCsv($nombreDeArchivo);



    echo "Lista de garages Del Archivo";
    foreach($listaDeGarage as $unGarage) 
    {
        echo $unGarage->MostrarGarage();
    }








?>