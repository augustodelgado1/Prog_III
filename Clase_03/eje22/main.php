<!-- Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado, Retorna
un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario. -->


<?php
require_once "./Usuario.php";

$mensaje = "Usuario no registrado si no coincide el mail";
$estadoDelUsuario;
$listaDeUsuarios = array(new Usuario("pepe","12345678"),new Usuario("Mario","12345658"),
                    new Usuario("Julio","laClaves"),new Usuario("Mario","Claveses"));
// var_dump($_POST);


    $UnUsuario = Usuario::BuscarPorMail($listaDeUsuarios,$_POST["mail"]);
    
    if(isset($UnUsuario))
    {
        $estadoDelUsuario = $UnUsuario->VerificarClave($_POST["clave"]);
        $mensaje = "Error en los datos";
        
        if($estadoDelUsuario !== false)
        {
            $mensaje = "Verificado";
        }
        
    }

    echo $mensaje;
 


   

?>