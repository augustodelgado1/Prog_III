<!-- Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado, Retorna
un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario. 



Alumno : Augusto Delgado 
Div : A332
-->


<?php
require_once "./Usuario.php";

$mensaje = "NO SE RECIBIERON DATOS";
$estadoDelUsuario;
$listaDeUsuarios = array(new Usuario("pepe","12345678"),new Usuario("Mario","12345658"),
                    new Usuario("Julio","laClaves"),new Usuario("Mario","Claveses"));
// var_dump($_POST);

    if($_server["REQUEST_METHOD"] == "POST" )
    {
        $UnUsuario = Usuario::BuscarPorMail($listaDeUsuarios,$_POST["mail"]);
        $mensaje = "Usuario no registrado si no coincide el mail";
        if(isset($UnUsuario))
        {
            $estadoDelUsuario = $UnUsuario->VerificarClave($_POST["clave"]);
            $mensaje = "Error en los datos";
            
            if($estadoDelUsuario !== false)
            {
                $mensaje = "Verificado";
            }
            
        }
    }

    echo $mensaje;
 


   

?>