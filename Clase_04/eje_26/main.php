<!-- 
Aplicación No 26 (RealizarVenta)
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
POST .
Verificar que el usuario y el producto exista y tenga stock.
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). carga
los datos necesarios para guardar la venta en un nuevo renglón.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesaris en las clases
-->
<!-- 
Alumno : Augusto Delgado 
Div : A332
-->

<?php

require_once "Producto.php";

$unProducto = null;
$unUsuario = null;
$unaVenta = null;
$nombreDeArchivo = "Ventas.json";
$listaDeProductos = array(new Producto("123456","Oreo","Gallatita",4,2100),new Producto("123457","Mellizas","Gallatita",7,1000)
,new Producto("123458","Opera","Gallatita",4,500));
$listaDeUsuarios = array(new Usuario("pepe","Julio@gmail.com","12345678"),
new Usuario("mario","mario@gmail.com","12345678"),new Usuario("Pergolino","pergolino@gmail.com","12345678"));

$mensaje = "No se recibieron datos";

if(isset($_POST["_codigoDeBarra"]) && isset($_POST["_id"]) && isset($_POST["cantidadDeItems"]))
{
    $unProducto = Producto::BuscarUnProductoPorCodigoDeBarra($listaDeProductos ,$_POST["_codigoDeBarra"]);
    $unUsuario  = Usuario::BuscarUnUsuarioPorId($listaDeUsuarios,$_POST["_id"]);
    $mensaje = "no se pudo hacer"; 

    if( isset( $unProducto) && isset( $unUsuario ) && ($unaVenta = $unProducto->RealizarVenta($_POST["_id"],$_POST["cantidadDeItems"])) !== null 
    && $unaVenta->EscribirUnaVentaPorJson($nombreDeArchivo))
    {
        $mensaje = "venta realizada";
    }
}

echo $mensaje;
?>