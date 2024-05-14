<!-- B- (1 pt.) PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), 
cantidad( de unidades). Se
guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente. -->


<?php

require_once 'Pizza.php';
$mensaje = "No se recibieron parametros";
$listaDePizza = Pizza::LeerListaJson("Pizza.json");
$unaPizza = null;


if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['tipo']) && isset($_GET['precio']) && isset($_GET['sabor']) 
&& isset($_GET['cantidad']) )
{
    $mensaje = "Se crea una nueva pizza";

    if(($unaPizza = Pizza::BuscarPizzaPorSaborYTipo($listaDePizza,$_GET['tipo'],$_GET['sabor'])) !== null
    && isset($unaPizza))
    {
        $mensaje = "Esta en la lista";
        $unaPizza->ActualizarPizza($_GET['precio'],$_GET['cantidad']);

    }else{
        $unaPizza = new Pizza($_GET['precio'],$_GET['cantidad'],$_GET['tipo'],$_GET['sabor']);
        if(isset($listaDePizza))
        {
            array_push($listaDePizza,$unaPizza);
        }
    }

    if(isset($listaDePizza))
    {
        Pizza::EscribirPizzaEnArrayJson($listaDePizza,"Pizza.json");
    }else{
        Pizza::EscribirPizzaEnArrayJson(array($unaPizza),"Pizza.json");
    }
    
}



echo $mensaje ;

?>