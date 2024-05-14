<!-- 3-
a- (1 pts.) AltaVenta.php: 
(por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
Pizza.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) 
y se
debe descontar la cantidad vendida del stock .
b- (1 pt) completar el alta con imagen de la venta , 
guardando la imagen con el tipo+sabor+mail(solo usuario hasta
el @) y fecha de la venta en la carpeta /ImagenesDeLaVenta. -->

<?php

require_once 'Pizza.php';
require_once 'Ventas.php';
$mensaje = "No se recibieron parametros";
$listaDePizza = Pizza::LeerListaJson("Pizza.json");
$unaVenta = null;

if(Ventas::CrearUnDirectorio("./Ventas") 
&& Ventas::CrearUnDirectorio("./Ventas/Fotos"))
{
    $mensaje = "Se Creo El directorio en donde se va guardar el archivo";
}

if($_SERVER['REQUEST_METHOD'] == 'POST' 
&& isset($_POST['tipo']) 
&& isset($_POST['sabor']) 
&& isset($_POST['email']) 
&& isset($_POST['cantidad']))
{
    $mensaje = "No hay stock";
    
    if(($unaPizza = Pizza::BuscarPizzaPorSaborYTipo($listaDePizza,$_POST['tipo'],$_POST['sabor'])) !== null)
    {
       
        $unaVenta = $unaPizza->RealizarVenta($_POST['email'],$_POST['cantidad']);
        // $unaVenta->AgregarUnaVentaBD();
        $nombreDeArchivo = $_POST['tipo'].$_POST['sabor'].$_FILES['foto']['name'];
        var_dump($nombreDeArchivo);
        $unaVenta->MoverFoto($_FILES['foto']['tmp_name'],'Ventas/Fotos',$nombreDeArchivo);
        $mensaje = "Se realizo la venta";
    }
}

echo $mensaje ;

?>