<!-- Aplicación No 28 ( Listado BD)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
cada objeto o clase tendrán los métodos para responder a la petición
devolviendo un listado en JSON -->


<?php
require_once "Usuario.php";
require_once "Producto.php";
require_once "Venta.php";
$listaDeUsuarios =  null;
$mensaje = "No se recibieron parametros por post";


switch($_GET['listado'])
{
    case 'usuarios':

        $mensaje = json_encode(Usuario::ObtenerListaDeUsuariosBD());
        if(!isset($mensaje ))
        {
            $mensaje = "No se pudo guardar la lista de usuarios en json";
        }
    break;

    case 'productos':
        $mensaje = json_encode(Producto::ObtenerListaDeProductosBD());
        if(!isset($mensaje ))
        {
            $mensaje = "No se pudo guardar la lista de producto en json";
        }
    break;

    case 'ventas':
        $mensaje = json_encode(Venta::ObtenerListaDeVentasBD());
        if(!isset($mensaje ))
        {
            $mensaje = "No se pudo guardar la lista de ventas en json";
        }
    break;

    default:
    $mensaje =json_encode(['mensaje' => 'Tipo de listado no válido']);
    break;
}

echo $mensaje;


?>