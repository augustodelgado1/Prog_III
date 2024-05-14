<!-- B- (1 pt.) HeladeriaAlta.php: (por POST) 
se ingresa Sabor, Precio, Tipo (“Agua” o “Crema”), 
Vaso (“Cucurucho”,
“Plástico”), Stock (unidades). 

Se guardan los datos en en el archivo de texto heladeria.json, tomando un id autoincremental como
identificador(emulado) .Sí el nombre y tipo ya existen , se actualiza el precio y se suma al stock existente.
completar el alta con imagen del helado, guardando la imagen con el sabor y tipo como identificación en la
carpeta /ImagenesDeHelados/2024.
--> 
<!-- 

Alumno: Augusto Delgado

 -->

<?php
require_once 'Helado.php';
$mensaje = "No se recibieron parametros";
$listaDeHelado = array();
$unHelado = null;
$unHeladoDeLaLista = null;
$estado = false;

if(Helado::CrearUnDirectorio("./ImagenesDeHelados") 
&& Helado::CrearUnDirectorio("./ImagenesDeHelados/2024"))
{
    $mensaje = "Se Creo El directorio en donde se va guardar el archivo";
}

if($_SERVER['REQUEST_METHOD'] == 'POST' 
&& isset($_POST['tipo']) 
&& isset($_POST['sabor']) 
&& isset($_POST['precio']) 
&& isset($_POST['vaso']) 
&& isset($_POST['stock']))
{
    $mensaje = "No se realizo el alta";
    $unHelado = Helado::ObtenerUnHeladoPorArrayAsosiativo($_POST);
    if(isset( $unHelado))
    {
        if(($unHeladoDeLaLista = Helado::BuscarHeladoPorTipoYSabor($listaDeHelado,$_POST['tipo'],$_POST['sabor'])) !== null)
        {
            $unHeladoDeLaLista->ActualizarHelado($_POST['precio'],$_POST['stock']);
            $mensaje = "se realizo el alta";
        }else{

            array_push($listaDeHelado,$unHelado);
            Helado::EscribirHeladoEnArrayJson($listaDeHelado,'heladeria.json');
            $mensaje = "se escribio el alta";
        }

        $unHelado->MoverFoto($_FILES['foto']['tmp_name'],"ImagenesDeHelados/2024/",$_FILES['foto']['name']);
    }
}

echo $mensaje;

?>