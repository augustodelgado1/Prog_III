<!-- 

Alumno: Augusto Delgado

 -->

 <!-- Se debe realizar una aplicación para dar de ingreso con imagen del item.
Se deben respetar los nombres de los archivos y de las clases.
Se debe crear una clase en PHP por cada entidad y los archivos PHP solo deben llamar a métodos de las clases.

1era parte

1-
A- (1 pt.) index.php:Recibe todas las peticiones que realiza el postman, y administra a qué archivo se debe incluir.
B- (1 pt.) HeladeriaAlta.php: (por POST) 
se ingresa Sabor, Precio, Tipo (“Agua” o “Crema”), 
Vaso (“Cucurucho”,
“Plástico”), Stock (unidades).



2-
(1pt.) HeladoConsultar.php: (por POST) Se ingresa Sabor y Tipo, si coincide con algún registro del archivo
heladeria.json, retornar “existe”. De lo contrario informar si no existe el tipo o el nombre.
3-
a- (1 pts.) AltaVenta.php: (por POST) se recibe el email del usuario y el Sabor, Tipo y Stock, 
si el ítem existe en
heladeria.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) .
Se debe descontar la cantidad vendida del stock.
b- (1 pt) Completar el alta de la venta con imagen de la venta (ej:una imagen del usuario),
 guardando la imagen
con el sabor+tipo+vaso+mail(solo usuario hasta el @) y fecha de la venta en la carpeta
/ImagenesDeLaVenta/2024. 



2da parte

4- (1 pts.)ConsultasVentas.php: (por GET)
Datos a consultar:
a- La cantidad de Helados vendidos en un día en particular(se envía por parámetro), si no se pasa fecha, se
muestran las del día de ayer.
b- El listado de ventas de un usuario ingresado.
c- El listado de ventas entre dos fechas ordenado por nombre.
d- El listado de ventas por sabor ingresado.
e- El listado de ventas por vaso Cucurucho.
5- (1 pts.) ModificarVenta.php (por PUT)
Debe recibir el número de pedido, el email del usuario, el nombre, tipo, vaso y cantidad, si existe se modifica , de
lo contrario informar que no existe ese número de pedido.
-->

<?php

switch ($_SERVER['REQUEST_METHOD'] ) {
    
    case 'POST':

        switch($_GET['accion'])
        {
           
            case 'altaHelado':
                require_once "HeladeriaAlta.php";
            break;

            case 'consultar':
                require_once "HeladoConsultar.php";
            break;

            case 'altaVenta':
                require_once "AltaVenta.php";
            break;
        }

    break;

    case "GET":
    {
        switch($_GET['accion'])
        {
            case 'carga':
                require_once "ConsultasVentas.php";
            break;
        }
    }

    case 'PUT':
        switch($_GET['accion'])
        {
            case 'carga':
                require_once "ModificarVenta.php";
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