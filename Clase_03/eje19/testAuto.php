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


<?php

    require_once "./Auto.php";

    if(!Auto::EscribirUnAuto(new Auto("Toyota","Rojo"),"autos.csv"))
    {
        echo"<br>No se pudo guardar un auto en el archivo <br>";
    }

    $garage[]  = new Auto("Toyota","Marron");

    //  Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
    $garage[]  = new Auto("Toyota","Gris",700);
    $garage[]  = new Auto("Toyota","Gris",900);

    // Crear un objeto “Auto” utilizando la sobrecarga restante
    $garage[] = new Auto("Ford","Amarillo",633,date_create('now')->setTimezone(new DateTimeZone("America/Argentina/Buenos_Aires"))->format("Y - m -d"));

    
    if(!Auto::EscribirArrayDeAutos($garage,"autos.csv"))
    {
        echo"<br>No se pudo guardar el array en el archivo <br>";
    }

    $listaDeAutos = Auto::LeerCsv("autos.csv");

    if(isset( $listaDeAutos))
    {
        var_dump($listaDeAutos);
    }else{
        echo "<br>No se pudo leer el archivo<br>";
    }



?>