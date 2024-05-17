<!--


//             4- ConsultaMovimientos.php: (por GET)
// Datos a consultar:
// a- El total depositado (monto) por tipo de cuenta y moneda en un día en
// particular (se envía por parámetro), si no se pasa fecha, se muestran las del día
// anterior.
// b- El listado de depósitos para un usuario en particular.
// c- El listado de depósitos entre dos fechas ordenado por nombre.
// d- El listado de depósitos por tipo de cuenta.
// e- El listado de depósitos por moneda.

 -->
<!-- 
    Alumno:Augusto Delgado
    Div A332
 -->
 <?php
require_once 'Clases/Deposito.php';

$mensaje = "No se recibieron parametros";
$listadoDeDepositos = Deposito::LeerJson(' depositos.json');

$fechaParticular = $_GET['fecha'];
$filtoDeListado = null;
if(!isset($fechaParticular))
{
    $fechaParticular = date("Y-m-d",strtotime('yesterday'));
}

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['listado']) )
{
    $mensaje = "no se pudo mostrar el listado";

   
    switch($_GET['listado'])
    {
        case 'fecha':
        
            $filtrarPorFecha = Deposito::FiltrarPorFecha($listadoDeDepositos,$fechaParticular);
            $totalDepositadoPorTipoDeCuenta = Deposito::ObtanerMontoTotalDepositado(Deposito::FiltrarPorTipoDeUsuario($filtrarPorFecha,$_GET['tipoDeCuenta']));
            $totalDepositadoPorMoneda = Deposito::ObtanerMontoTotalDepositado(Deposito::FiltrarPorTipoDeMoneda($filtrarPorFecha,$_GET['tipoDeMoneda']));
        
            if(isset($filtrarPorFecha) && $totalDepositadoPorTipoDeCuenta >= 0
            && $totalDepositadoPorMoneda >= 0)
            {
                $mensaje = "el monto total depositado del tipo de cuenta ".$_GET['tipoDeCuenta']."es $totalDepositadoPorTipoDeCuenta".'<br>'.
                "el monto total Depositado del tipo De moneda".$_GET['tipoDeMoneda']."es $totalDepositadoPorMoneda".'<br>';
            }

        break;

        case 'depositos_usuario':
            if( isset($_GET['numeroDeCuenta']))
            {
                $filtrarPorFecha = Deposito::FiltrarPorUsuario($listadoDeDepositos,$_GET['numeroDeCuenta']);
            }
            break;

        case 'fecha_ordenado':
            if(isset($_GET['fechaDesde']) && isset($_GET['fechaHasta']))
            {
                $filtoDeListado = Deposito::FiltrarDesdeUnaFecha($listadoDeDepositos,$_GET['fechaDesde'],$_GET['fechaHasta']);
                if(isset($filtrarPorFecha))
                {
                    usort($filtoDeListado,array('Usuario', 'CompararPorNombre'));
                }
            }
            break;

        case 'tipo_De_Cuenta':
            if(isset($_GET['tipoDeCuenta']))
            {
                $filtoDeListado = Deposito::FiltrarPorTipoDeUsuario($listadoDeDepositos,$_GET['tipoDeCuenta']);
            }
            
            break;

        case 'tipo_De_Moneda':
            if(isset($_GET['tipoMoneda']))
            {
                $filtoDeListado = Deposito::FiltrarPorTipoDeMoneda($listadoDeDepositos,$_GET['tipoMoneda']);
            }
            break;

        default:
        $mensaje =  "Listado no valido";
        break;
    }
}

if(isset($filtoDeListado) && count($filtoDeListado))
{
    $mensaje = Deposito::ToStringList($filtoDeListado );
}

echo $mensaje ;

?>