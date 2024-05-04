<!-- 
Aplicación No 25 ( AltaProducto)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST ,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un objeto y
utilizar sus métodos para poder verificar si es un producto existente, si ya existe el producto se le
suma el stock , de lo contrario se agrega al documento en un nuevo renglón
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

$unProducto = null;
$nombreDeArchivo = "Usuario.json";
$listaDeProducto = array(new Producto("123456","Oreo","Gallatita",1,2100),new Producto("123457","Mellizas","Gallatita",1,1000)
,new Producto("123458","Opera","Gallatita",1,500));

$mensaje = "NO SE RECIBIERON DATOS";

if($_SERVER['REQUEST_METHOD'] == "POST" 
&& ($unProducto = Producto::ObtenerUnProductoPorArrayAsosiativo($_POST)) !== null) 
{
    $mensaje = $unProducto->EvaluarUnProducto($listaDeProducto,$nombreDeArchivo);
}

echo $mensaje;
?>