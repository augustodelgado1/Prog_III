<!-- Aplicación No 30 ( AltaProducto BD)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras )
,nombre ,tipo, stock, precio )por POST
, carga la fecha de creación y crear un objeto ,
se debe utilizar sus métodos para poder
verificar si es un producto existente,
si ya existe el producto se le suma el stock , de lo contrario se agrega .
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase 
-->

<!-- 
Alumno : Augusto Delgado 
Div : A332
-->


<?php
require_once "Producto.php";
$listaDeUsuarios =  null;
$mensaje = "No se recibieron parametros por post";

if(($unProducto = Producto::ObtenerUnProductoPorArrayAsosiativo($_POST)) !== null)
{
    $mensaje = $unProducto->EvaluarUnProducto();
}

echo $mensaje;


?>
