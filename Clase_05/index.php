<?php

switch ($_SERVER['REQUEST_METHOD'] ) {
    
    case 'POST':

        switch($_GET['accion'])
        {
            case 'Registro BD':
                require_once "registro.php";
            break;

            case 'AltaProducto BD':
                require_once "altaProducto.php";
            break;

            case 'Login con bd':
                require_once "Login.php";
            break;
        }

    break;

    case "GET":
    {
        switch($_GET['accion'])
        {
            case 'Listado BD':
                require_once "listado.php";
            break;
        }
    }
    
    default:
        echo "Peticion no permitida";
        break;
}

?>