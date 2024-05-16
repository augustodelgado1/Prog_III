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
require_once 'Clases/File.php';
require_once 'Clases/File.php';
$mensaje = "No se recibieron parametros";
$listaDeHelado = array();
$unHelado = null;
$unHeladoDeLaLista = null;
$estado = false;

if(File::CrearUnDirectorio("./ImagenesDeHelados") 
&& File::CrearUnDirectorio("./ImagenesDeHelados/2024"))
{
    $mensaje = "Se Creo El directorio en donde se va guardar el archivo";
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tipo']) && isset($_POST['sabor']) && isset($_POST['precio']) 
&& isset($_POST['vaso']) 
&& isset($_POST['stock']))
{
    $mensaje = "No se realizo el alta";
    $listaDeHeladosDeUnSabor = Helado::FitrarHeladosPorSabor($listaDeHelado,$_POST['sabor']);
    $unHeladoDeLaLista = Helado::BuscarHeladoPorTipo($listaDeHeladosDeUnSabor,$_POST['tipo']);

    if(isset( $unHeladoDeLaLista ))
    {
        $unHeladoDeLaLista->ActualizarHelado($_POST['precio'],$_POST['stock']);
        $mensaje = "se Actualizo el producto";
    }else{

        $unHelado = Helado::ObtenerUnHeladoPorArrayAsosiativo($_POST);
        $unHelado->SetImagen($_FILES['foto']['tmp_name'],$_FILES['foto']['name']);
        $unHelado->MoverImagen("ImagenesDeHelados/2024/");
        array_push($listaDeHelado,$unHelado);
        Helado::EscribirHeladoEnArrayJson($listaDeHelado,'heladeria.json');
        $mensaje = "se dio de alta el Helado";
    }
}

echo $mensaje;

?>