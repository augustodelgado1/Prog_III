<!--
 Aplicación No 27 (Registro BD)
Archivo: registro.php
método:POST
Recibe los datos del 
usuario( nombre,apellido, clave,mail,localidad )
por POST , crear
un objeto con la fecha de registro y 
utilizar sus métodos para poder hacer el alta,
guardando los datos la base de datos
retorna si se pudo agregar o no. 
-->

<?php
require_once "Usuario.php";
$unUsuario = null;
$mensaje = "No se recibieron parametros por post";


if(($unUsuario = Usuario::ObtenerUnUsuarioPorArrayAsosiativo($_POST)) !== null)
{
    $mensaje =  "No se pudo agrego el usuario";

    if($unUsuario->AgregarUnUsuarioBD())
    {
        $mensaje =  "Se agrego el usuario";
    }
}

echo $mensaje;


?>