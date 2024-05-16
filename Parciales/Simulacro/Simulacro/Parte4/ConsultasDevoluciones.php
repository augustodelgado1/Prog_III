

<!-- 


9- (2 pts.) ConsultasDevoluciones.php:-
a- Listar las devoluciones con cupones.
b- Listar solo los cupones y su estado.
c- Listar devoluciones y sus cupones y si fueron usados

 -->
<!-- 
    Alumno:Augusto Delgado
    Div A332
 -->
 <?php
require_once 'CuponDescueto.php';
require_once 'Devolucion.php';
$mensaje = "No se recibieron parametros";
$listaDeCupones = CuponDescuento::LeerJson("cupones.json");
$listaDeDevoluciones = Devolucion::LeerJson("devoluciones.json");

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['listado']) )
{
    switch($_GET['listado'])
    {
        // a- Listar las devoluciones con cupones.
        case 'devoluciones_con_cupones':
            $mensaje = CuponDescuento::MostrarDevolucionesConCupones($listaDeDevoluciones,$listaDeCupones);
        break;

        // b- Listar solo los cupones y su estado.
        case 'cupones':
            $mensaje = CuponDescuento::ToStringList($listaDeCupones);
            break;

        // c- Listar devoluciones y sus cupones y si fueron usados
        case 'devoluciones_con_cupones_usados':
            $listaDeCuponesUsados = CuponDescuento::FiltrarPorEstados($listaDeCupones,true);
            $mensaje = CuponDescuento::MostrarDevolucionesConCupones($listaDeDevoluciones,$listaDeCuponesUsados);
            break;

        default:
        $mensaje =  "Listado no valido";
        break;
    }
}

if(!isset($mensaje))
{
    $mensaje = "El listado no contiene ningun elemento del pedido";
}
echo $mensaje ;


?>