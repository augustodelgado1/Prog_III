<!-- (1pt.) HeladoConsultar.php: (por POST) 
Se ingresa Sabor y Tipo, si coincide con algún registro del archivo
heladeria.json, retornar “existe”. De lo contrario informar si no existe el tipo o el nombre. -->
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