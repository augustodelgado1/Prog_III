

<!-- Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);
En testAuto.php:
 Crear dos objetos “Auto” de la misma marca y distinto color.
 Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
 Crear un objeto “Auto” utilizando la sobrecarga restante.
 Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500 al
atributo precio.
 Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el resultado
obtenido.
 Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.
 Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5)

Augusto Delgado
 --> 
<?php

Require_once "Auto.php";

$garage = array();
$suma;
// Crear dos objetos “Auto” de la misma marca y distinto color.
$garage[]  = new Auto("Toyota","Rojo");
$garage[]  = new Auto("Toyota","Marron");

//  Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
$garage[]  = new Auto("Toyota","Gris",700);
$garage[]  = new Auto("Toyota","Gris",900);

// Crear un objeto “Auto” utilizando la sobrecarga restante
$garage[] = new Auto("Ford","Amarillo",633,date_create('now')->setTimezone(new DateTimeZone("America/Argentina/Buenos_Aires"))->format("Y - m -d"));

// // //  Utilizar el método “AgregarImpuesto” 
// // en los últimos tres objetos, 
// agregando $ 1500 al
// // // atributo precio.

$len = count($garage)-1;

// var_dump($garage);

for ($i = $len; $i >= 3; $i--) {
    $garage[$i]->AgregarImpuestos(1500);
}

// Obtener el 
// importe sumado del primer 
// objeto “Auto” más el segundo y 
// mostrar el resultado
// obtenido.

echo "Suma del segundo objeto Auto más el tercero <br> Resultado:<br> ";

if(($suma = Auto::Add($garage[2],$garage[3])) > 0)
{
    echo "el resultado de la suma es {$suma}";

} else{
    echo "No se pudo realizar la operacion";
}


if(($suma = Auto::Add($garage[0],$garage[1])) > 0)
{
    echo "el resultado de la suma es {$suma}";

} else{
    echo "No se pudo realizar la operacion";
}



// Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o no.

echo "<br>Comparacion del primer “Auto” con el segundo <br> Resultado:<br> ";

if($garage[0]->Equals($garage[1]))
{
    echo "Son iguales";
}else{
    echo "No Son iguales";
}

echo "<br><br>Comparacion del primer “Auto” con el quinto <br> Resultado:<br> ";

if($garage[0]->Equals($garage[3]))
{
    echo "Son iguales";
}else{
    echo "No Son iguales";
}


// Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3, 5)

echo "<br><br>Autos Impares:<br>";

for ($i = 0; $i <= $len; $i++) {

    if($i %2 != 0)
    {
        echo "<br> Auto [$i] Datos: <br>  ".Auto::MostrarAuto($garage[$i]);
    }
}

?>