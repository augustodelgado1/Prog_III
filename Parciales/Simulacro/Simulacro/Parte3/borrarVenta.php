<!-- 
7- (1 pts.) borrarVenta.php (por DELETE), debe recibir un número de pedido,se borra la venta(soft-delete, no
físicamente) 
y la foto relacionada a esa venta debe moverse a la carpeta /ImagenesBackupVentas/2024.
 -->
<!-- 
    Alumno:Augusto Delgado
    Div A332
 -->
 <?php
require_once 'Ventas.php';
require_once 'File.php';
$mensaje = "No se recibieron parametros";
$listaDeVentas = Venta::LeerJson("Ventas.json");
$numeroDePedido = $_GET['numeroDePedido'];

if($_SERVER['REQUEST_METHOD'] == 'DELETE' 
&& isset($numeroDePedido))
{
    $mensaje = "no existe el número de pedido {$numeroDePedido}";
    
    if(($index = Venta::BuscarUnaVentaPorNumeroDePedido($listaDeVentas, $numeroDePedido)) >= 0
    && Venta::Borrar($listaDeVentas,$index) !== false)
    {
        $mensaje = "Se elimino con exito";
    }
}

echo $mensaje ;

?>