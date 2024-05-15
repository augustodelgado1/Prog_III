<!-- 3-
a- (1 pts.) AltaVenta.php: (por POST) se recibe el email del usuario y el Sabor, Tipo y Stock, 
si el ítem existe en
heladeria.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) .
Se debe descontar la cantidad vendida del stock.
b- (1 pt) Completar el alta de la venta con imagen de la venta (ej:una imagen del usuario),
 guardando la imagen
con el sabor+tipo+vaso+mail(solo usuario hasta el @) y fecha de la venta en la carpeta
/ImagenesDeLaVenta/2024.


- (2 pts.) AltaVenta.php, …( continuación de 1ra parte, punto 3) Todo lo anterior más…
a- Debe recibir el cupón de descuento (si existe) 
y guardar el importe final y el descuento aplicado en el archivo.
b- Debe marcarse el cupón como ya usado.

-->

<?php

require_once 'Ventas.php';
require_once 'Helado.php';
require_once 'AccesoDatosJson.php';

$mensaje = "No se recibieron parametros";
$listaDeHelado = Helado::LeerListaJson("Heladeria.json");
$unaVenta = null;
$userDelUsuario = null;

if(File::CrearUnDirectorio("./ImagenesDeLaVenta") 
&& File::CrearUnDirectorio("./ImagenesDeLaVenta/2024"))
{
    $mensaje = "Se Creo El directorio en donde se va guardar el archivo";
}

if($_SERVER['REQUEST_METHOD'] == 'POST' 
&& isset($_POST['tipo']) 
&& isset($_POST['sabor']) 
&& isset($_POST['email']) 
&& isset($_POST['stock']))
{
    $mensaje = "No hay stock";

    var_dump($listaDeHelado);
    
    if(($unaVenta = $unaHelado->RealizarVenta($_POST['email'],$_POST['stock'])) !== null
    && isset($unaVenta) &&  ($userDelUsuario = Venta::recortarHastaCaracter($_POST['email'], '@')) !== null)
    {
        Venta::EscribirVentaEnArrayJson(array($unaVenta),"Ventas.json");
        $nombreDeArchivo = $_POST['sabor'].$_POST['tipo'].$unaHelado->getVaso().$userDelUsuario.$_FILES['foto']['name'];
        $unaVenta->SetFoto($_FILES['foto']['tmp_name'],$nombreDeArchivo);
        $unaVenta->ModificarFoto('ImagenesDeLaVenta/2024/',$nombreDeArchivo);
        $mensaje = "Se realizo la venta";
    }

    
}

echo $mensaje ;

?>