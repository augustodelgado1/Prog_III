<!-- (1pt.) HeladoConsultar.php: (por POST) 
Se ingresa Sabor y Tipo, si coincide con algún registro del archivo
heladeria.json, retornar “existe”. De lo contrario informar si no existe el tipo o el nombre. -->
<?php
require_once 'Helado.php';
$mensaje = "No se recibieron parametros";
$listaDeHelado = Helado::LeerListaJson("Heladeria.json");
$unHelado = null;
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tipo']) && isset($_POST['sabor']) )
{
    $mensaje = "no existe";
    $listaDeHeladoDeUnSabor  = Helado::FitrarHeladosPorSabor($listaDeHelado,$_POST['sabor']);
    $unHelado =  Helado::BuscarHeladoPorTipo($listaDeHeladoDeUnSabor,$_POST['tipo']);
    if(isset( $unHelado))
    {
        $mensaje = "existe";
    }else{

        $mensaje = "No Existe el tipo";

        if(isset($listaDeHeladoDeUnSabor) == false 
        || count($listaDeHeladoDeUnSabor) <= 0)
        {
            $mensaje = "No Existe el sabor";
        }
    }
}

echo $mensaje ;

?>