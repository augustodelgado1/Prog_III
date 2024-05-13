<!-- Aplicación No 29( Login con bd)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado en la
base de datos,
Retorna un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario. -->

<?php
require_once "Usuario.php";
$listaDeUsuarios =  null;
$mensaje = "No se recibieron parametros por post";

if(($unUsuario = Usuario::ObtenerUnUsuarioPorArrayAsosiativoPorMailYClave($_POST)) !== null)
{
    $mensaje = "Usuario no registrado";
    
    if($unUsuario->VerificarUnUsuarioBD())
    {
        $mensaje = "Verificado";

    }else{

        if($unUsuario->VerificarUnUsuarioPorMailBD())
        {
            $mensaje = "Error en los datos";
        }
    }
}

echo $mensaje;


?>