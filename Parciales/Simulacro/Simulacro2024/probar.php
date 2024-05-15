<!-- 




 -->
<!-- 
    Alumno:Augusto Delgado
    Div A332
 -->
 <?php
require_once 'File.php';

$mensaje = "No se recibieron parametros";

var_dump(File::MoverFoto("prueva/".$_FILES['foto']['name'],'ImagenesDeLaVenta/2024/',$_FILES['foto']['name']))
?>