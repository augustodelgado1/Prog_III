<?php
// Key

$carpetas_archivos = "./Archivos/";

$nombreDeArchivo = $_FILES['']['name'];


$tipoDelarchivo = $_FILES['']['type'];
$tamanioDelarchivo = $_FILES['']['size'];

$ruta_destino = $carpetas_archivos . $nombreDeArchivo;

//Donde este ubicado
// A donde lo queremos mover
// Retorno : true (Si lo pudo cargar) , o false de caso contrario
if(move_uploaded_file($_FILES['']['tmp_name'],$ruta_destino ))
{
    echo"";
}


?>