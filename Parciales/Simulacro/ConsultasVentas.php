<!-- 4- (1 pts.)ConsultasVentas.php: (por GET)
Datos a consultar:
a- La cantidad de Helados 
vendidos en un día en particular(se envía por parámetro), si no se pasa fecha, se
muestran las del día de ayer.
b- El listado de ventas de un usuario ingresado.
c- El listado de ventas entre dos fechas ordenado por nombre.
d- El listado de ventas por sabor ingresado.
e- El listado de ventas por vaso Cucurucho. -->

<?php
require_once 'Helado.php';
$mensaje = "No se recibieron parametros";
$listaDeHelado = Helado::LeerListaJson("Heladeria.json");

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tipo']) && isset($_POST['sabor']) )
{
    $mensaje = "no existe";
    
    if(($unaHelado = Helado::BuscarHeladoPorTipoYSabor($listaDeHelado,$_POST['tipo'],$_POST['sabor'])) !== null)
    {
        $mensaje = "existe";
    }else{

        if(Helado::BuscarHeladoPorSabor($listaDeHelado,$_POST['sabor']))
        {
            $mensaje = "No Existe el tipo";
        }else{

            if(Helado::BuscarHeladoPorTipo($listaDeHelado,$_POST['tipo']) !== null)
            {
                $mensaje = "No Existe el sabor";
            }
        }
    }
}

echo $mensaje ;

?>