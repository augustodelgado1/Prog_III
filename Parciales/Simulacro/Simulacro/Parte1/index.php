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

3ra parte
6- (2 pts.) DevolverHelado.php (por POST),
Guardar en el archivo (devoluciones.json y cupones.json):
a- Se ingresa el número de pedido y la causa de la devolución. El número de pedido debe existir, se ingresa una
foto del cliente enojado,esto debe generar un cupón de descuento (id, devolucion_id, porcentajeDescuento,
estado[usado/no usado]) con el 10% de descuento para la próxima compra.

7- (1 pts.) borrarVenta.php (por DELETE), debe recibir un número de pedido,se borra la venta(soft-delete, no
físicamente) y la foto relacionada a esa venta debe moverse a la carpeta /ImagenesBackupVentas/2024.

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

            case 'devolver':
                require_once "DevolverHelado.php";
            break;

            case 'probar':
                require_once "probar.php";
            break;
        }

    break;

    case "GET":
    {
        switch($_GET['accion'])
        {
            case 'consultas_ventas':
                require_once "ConsultasVentas.php";
            break;

            case 'consultas_devoluciones':
                require_once "ConsultasDevoluciones.php";
            break;

            
        }
    }

    case 'PUT':
        switch($_GET['accion'])
        {
            case 'modificar_venta':
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