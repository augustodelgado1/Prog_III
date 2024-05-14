<?php

switch ($_SERVER['REQUEST_METHOD'] ) {
    
    case 'POST':

        switch($_GET['accion'])
        {
           
            case 'consultar':
                require_once "PizzaConsultar.php";
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
            case 'carga':
                require_once "PizzaCarga.php";
            break;
        }
    }

    case 'PUT':
        switch($_GET['accion'])
        {
            case 'carga':
                require_once "PizzaCarga.php";
            break;
        }
    break;


    
    case 'DELETE':
        switch($_GET['accion'])
        {
            case 'carga':
                require_once "PizzaCarga.php";
            break;
        }
    break;
    
    default:
        echo "Peticion no permitida";
        break;
}

?>