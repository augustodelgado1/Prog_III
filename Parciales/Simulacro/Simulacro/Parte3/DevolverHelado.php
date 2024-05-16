<!-- 
6- (2 pts.) DevolverHelado.php (por POST),
Guardar en el archivo (devoluciones.json y cupones.json):
a- Se ingresa el número de pedido y la causa de la devolución. El número de pedido debe existir
, se ingresa una
foto del cliente enojado,esto debe generar un cupón de descuento (id, devolucion_id, porcentajeDescuento,
estado[usado/no usado]) con el 10% de descuento para la próxima compra.
 -->
<!-- 
    Alumno:Augusto Delgado
    Div A332
 -->
 <?php
require_once 'Devolucion.php';
require_once 'Ventas.php';
require_once 'CuponDescueto.php';
$mensaje = "No se recibieron parametros";
$listaDeHelado = Venta::LeerJson("Ventas.json");
$index = -1;


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['causa']) && isset($_POST['numeroDePedido']) )
{
    $mensaje = "no existe";
    $index = Venta::BuscarUnaVentaPorNumeroDePedido($listaDeHelado ,$_POST['numeroDePedido']);
    
    if($index >= 0)
    {
        $unaDevolusion = new Devolucion($_POST['causa'],$_FILES['foto']['tmp_name'],$_FILES['foto']['name']);
        $unCupon = new CuponDescuento($unaDevolusion->GetId(),10);
        $mensaje = "Se guardo correctamente";
        if( Devolucion::EscribirDevolucionEnArrayJson(array($unaDevolusion),'devoluciones.json') == false|| 
        CuponDescuento::EscribirCuponDescuentoEnArrayJson(array($unCupon),'cupones.json') == false)
        {
            $mensaje = "no se pudo guardar el archivo";
        }
    }
}

echo $mensaje ;

?>