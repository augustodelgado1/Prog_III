<!-- 4- (1 pts.)ConsultasVentas.php: (por GET)
Datos a consultar:
a- La cantidad de Helados 
vendidos en un día en particular(se envía por parámetro), si no se pasa fecha, se
muestran las del día de ayer.
b- El listado de ventas de un usuario ingresado.
c- El listado de ventas entre dos fechas ordenado por nombre.
d- El listado de ventas por sabor ingresado.
e- El listado de ventas por vaso Cucurucho. -->

<?php
require_once 'Helado.php';
$mensaje = "No se recibieron parametros";
$listaDeHelado = Helado::LeerListaJson("Heladeria.json");
$listadoDeUsuariosCompraron = null;
$unUsuario = null;
$listadoDeVentas = Venta::LeerJson('Ventas.json');
$listaDeHeladosVendidios = null;
$cantidad = 0;
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['listado']) )
{
    $mensaje = "no se recibio el parametro";

    switch($_GET['listado'])
    {
        case 'fecha':
            $fechaParticular = $_GET['fecha'];
            if(!isset($fechaParticular))
            {
                $fechaParticular = date("Y-m-d",strtotime('yesterday'));
            }
            $cantidad = Venta::ContarPorUnaFecha($listadoDeVentas,  $fechaParticular);
            $mensaje = "la cantidad de ventas vendidas es $cantidad";
        break;

        case 'ventas_usuario':
            if( isset($_GET['usuario']))
            {
                $filtrarPorUsuario = Venta::FiltrarPorUsuario($listadoDeVentas,$unUsuario);
                $mensaje = Venta::StrListaVenta($filtrarPorUsuario);
            }
            break;

        case 'fecha_ordenado':
            if(isset($_GET['fechaDesde']) && isset($_GET['fechaHasta']))
            {
                $filtrarPorFecha = Venta::FiltrarPorFecha($listadoDeVentas,$_GET['fechaDesde'],$_GET['fechaHasta']);
                usort($filtrarPorFecha,['Usuario', 'CompararPorNombre']);
                $mensaje = Venta::StrListaVenta($filtrarPorFecha);
            }
            break;

        case 'sabor':
            if(isset($_GET['sabor']))
            {
                $mensaje = Venta::StrListaVenta(Venta::FiltrarPorSaborDeHelado($listadoDeVentas,$_GET['sabor']));
            }
            break;

        case 'vaso':
            if(isset($_GET['vaso']))
            {
                $mensaje = Venta::StrListaVenta(Venta::FiltrarPorVasoDeHelado($listadoDeVentas,$_GET['vaso']));
            }
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