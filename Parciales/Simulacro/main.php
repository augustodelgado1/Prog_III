
<!-- 




 -->
<!-- 
    Alumno:Augusto Delgado
    Div A332
 -->
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
    }
}

echo $mensaje ;

?>