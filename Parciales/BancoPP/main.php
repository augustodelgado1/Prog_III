
<!-- 




 -->
<!-- 
    Alumno:Augusto Delgado
    Div A332
 -->
<?php
require_once 'Clases/clase.php';
$mensaje = "No se recibieron parametros";

// File::CrearUnDirectorio("./ImagenesDeHelados") 
//     File::CrearUnDirectorio("./ImagenesDeHelados/2024")

Clase::EscribirClaseEnArrayJson(array(Clase::ObtenerUnClasePorArrayAsosiativo($_POST)),'clase.json');
$lista = Clase::LeerJson('clase.json');
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tipo']) && isset($_POST['sabor']) )
{
    $mensaje = "no existe";
    
    if(true)
    {
        $mensaje = "existe";
    }
}
var_dump($lista);

$mensaje = Clase::ToStringList($lista);
echo $mensaje;



?>