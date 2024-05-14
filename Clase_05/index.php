<!-- 
Aplicación No 31 (RealizarVenta BD )
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems
,por POST .
Verificar que el usuario y el producto exista y tenga stock.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en las clases

Aplicación No 32(Modificacion BD)
Archivo: ModificacionUsuario.php
método:POST
Recibe los datos del usuario(nombre, clavenueva, clavevieja,mail )por POST
, crear un objeto y utilizar sus métodos para poder hacer la modificación,
guardando los datos la base de datos
retorna si se pudo agregar o no.
Solo pueden cambiar la clave

Aplicación No 33 ( ModificacionProducto BD)
Archivo: modificacionproducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
,
crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
si ya existe el producto el stock se sobrescribe y se cambian todos los datos excepto:
el código de barras .
Retorna un :
“Actualizado” si ya existía y se actualiza
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase -->
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