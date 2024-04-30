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
    
    default:
        echo "Peticion no valida";
        break;
}

?>