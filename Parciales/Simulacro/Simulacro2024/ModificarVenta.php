
<!-- 
5- (1 pts.) ModificarVenta.php (por PUT)
Debe recibir el número de pedido, el email del usuario, 
el nombre, tipo, vaso y cantidad, si existe se modifica , de
lo contrario informar que no existe ese número de pedido.
 -->
<!-- 
    Alumno:Augusto Delgado
    Div A332
 -->
 <?php
require_once 'Ventas.php';
$mensaje = "No se recibieron parametros";
$listaDeVentas = Venta::LeerJson("Ventas.json");

$numeroDePedido = $_GET['numeroDePedido'];

if($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($numeroDePedido)  
&& ($unaVenta = Venta::ObtenerUnaVentaPorArrayAsosiativo($_GET)) !== null)
{
    $mensaje = "no existe el número de pedido {$numeroDePedido}";
    
    if(($index = Venta::BuscarUnaVentaPorNumeroDePedido($listaDeVentas, $numeroDePedido)) >= 0
    && $unaVenta->Modificar($listaDeVentas,$index) !== false)
    {
        $mensaje = "Se modifico con exito";
        // Venta::EscribirVentaEnArrayJson($listaDeVentas,"Ventas.json");
    }
}

echo $mensaje ;

?>