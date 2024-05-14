<!-- 
1era parte

1-
A- (1 pt.) index.php:Recibe todas las peticiones 
que realiza el postman, 
y administra a que archivo se debe incluir.

B- (1 pt.) PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.
2-
(1pt.) PizzaConsultar.php: (por POST)Se ingresa Sabor,Tipo, 
si coincide con algún registro del archivo Pizza.json,
retornar “Si Hay”. De lo contrario informar 
si no existe el tipo o el sabor. 

2da parte

3-
a- (1 pts.) AltaVenta.php: 
(por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
Pizza.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) 
y se
debe descontar la cantidad vendida del stock .
b- (1 pt) completar el alta con imagen de la venta , guardando la imagen con el tipo+sabor+mail(solo usuario hasta
el @) y fecha de la venta en la carpeta /ImagenesDeLaVenta.

3era parte

4- (3 pts.)ConsultasVentas.php: necesito saber :
a- la cantidad de pizzas vendidas
b- el listado de ventas entre dos fechas ordenado por sabor.
c- el listado de ventas de un usuario ingresado
d- el listado de ventas de un sabor ingresado

4ta parte
5- (2 pts.)PizzaCarga.php:.(continuación) Cambio de get a post.
completar el alta con imagen de la pizza, guardando la imagen con el tipo y el sabor como nombre en la carpeta
/ImagenesDePizzas.

6- (2 pts.) ModificarVenta.php(por PUT), debe recibir el número de pedido, el email del usuario, el sabor,tipo y
cantidad, si existe se modifica , de lo contrario informar.

7- (2 pts.) borrarVenta.php(por DELETE), debe recibir un número de pedido,se borra la venta y la foto se mueve a
la carpeta /BACKUPVENTAS
-->

<?php

switch ($_SERVER['REQUEST_METHOD'] ) 
{
    
    case 'POST':

        switch($_GET['accion'])
        {
           
            case 'consultar':
                require_once "PizzaConsultar.php";
            break;

            case 'alta':
                require_once "AltaVenta.php";
            break;

            case 'carga':
                require_once "PizzaCarga.php";
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
            case 'modificar':
                require_once "ModificarVenta.php";
            break;
        }
    break;


    
    case 'DELETE':
        switch($_GET['accion'])
        {
            case 'borrar':
                require_once "borrarVenta.php";
            break;
        }
    break;
    
    default:
        echo "Peticion no permitida";
        break;
}

?>