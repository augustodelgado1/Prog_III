
<!-- 




 -->
<!-- 
    Alumno:Augusto Delgado
    Div A332
 -->
<?php
require_once 'Helado.php';
$mensaje = "No se recibieron parametros";
$listaDeHelado = Helado::LeerListaJson("Archivos/Heladeria.json");
File::CrearUnDirectorio("./Archivos");
// File::CrearUnDirectorio("./ImagenesDeHelados") 
//     File::CrearUnDirectorio("./ImagenesDeHelados/2024")

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tipo']) && isset($_POST['sabor']) )
{
    $mensaje = "no existe";
    
    if(true)
    {
        $mensaje = "existe";
    }
}

echo $mensaje ;

?>