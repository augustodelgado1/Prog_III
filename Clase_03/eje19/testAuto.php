<!-- En testAuto.php:
● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio. ● Crear
un objeto “Auto” utilizando la sobrecarga restante.
● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al
atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5) -->


<!-- 

Alumno : Augusto Delgado 
Div : A332
-->



<?php

    require_once "./Auto.php";

    
//     Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un archivo
// autos.csv.
// Hacer los métodos necesarios en la clase Auto para poder leer el listado desde el archivo
// autos.csv
// Se deben cargar los datos en un array de autos.

    $marca = array("Toyota","Ford","Wodswagen");
    $colores = array("Marron","Rojo","Amarillo");

    //CARGO 5 AUTOS
    for ($i = 0; $i < 5; $i++)
    {
        if(!Auto::AltaDeAuto("autos.csv",$marca[rand(0,count($marca)-1)],$colores[rand(0,count($colores)-1)]))
        {
            echo"<br>No se pudo guardar el auto en el archivo <br>";
            break;
        }
    }


    $garage = Auto::LeerCsv("autos.csv");

    echo"<br>Se lee los Datos del archivo <br>";

    if(isset($garage) && count($garage) > 0)
    {
        foreach ($garage as $unAuto)
        {
            echo  Auto::MostrarAuto($unAuto);
        }
    }else{
        echo "No Se pudo leer el archivo";
    }


 

    

   



?>