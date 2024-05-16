<?php


switch ($_SERVER['REQUEST_METHOD'] ) {
    
    case 'POST':

        switch($_GET['accion'])
        {
           
            case 'alta_cuenta':
                require_once "CuentaAlta.php";
            break;

            case 'consulta_cuenta':
                require_once "ConsultarCuenta.php";
            break;

            case 'deposito_cuenta':
                require_once "DepositoCuenta.php";
            break;

            case 'prueba':
                require_once "main.php";
            break;

            default:
            $mensaje = "Peticion no permitida";
            break;
        }

    break;

    case "GET":
    {
        switch($_GET['accion'])
        {
            case 'carga':
                require_once "PizzaCarga.php";
            break;

            default:
            $mensaje = "Peticion no permitida";
            break;
        }
    }

    case 'PUT':
        switch($_GET['accion'])
        {
            case 'carga':
                require_once "PizzaCarga.php";
            break;

            default:
            $mensaje = "Peticion no permitida";
            break;
        }
    break;


    
    case 'DELETE':
        switch($_GET['accion'])
        {
            case 'carga':
                require_once "PizzaCarga.php";
            break;

            default:
            $mensaje = "Peticion no permitida";
            break;
        }
    break;
    
    default:
    $mensaje = "Peticion no permitida";
        break;
}

echo $mensaje;
?>