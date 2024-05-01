<?php

switch ($_SERVER['REQUEST_METHOD'] ) {
    
    case 'POST':

        switch($_GET['accion'])
        {
            case 'Registro JSON':
                require_once "./eje_23/main.php";

            break;
        }

    break;

    case "GET":
    {
        switch($_GET['accion'])
        {
            case 'Listado JSON y array de usuarios':
                require_once "./eje_24/main.php";
            break;
        }
    }
    
    default:
        // echo "Peticion no permitida";
        break;
}

?>