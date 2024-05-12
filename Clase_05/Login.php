<!-- Aplicación No 29( Login con bd)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado en la
base de datos,
Retorna un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario. -->

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