<!-- Aplicación No 20 BIS (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario -->

<?php

require_once "./Usuario.php";
$unUsuario = null ;
$mensaje = "Parametros no validos";
$nombreDeArchivo = "usuarios.csv";

    if(isset($_POST["mail"]) && isset($_POST["nombre"]) && isset($_POST["clave"])) 
    {
        $unUsuario = Usuario::AltaDeUsuario($_POST["nombre"], $_POST["mail"],$_POST["clave"]);
        $mensaje = "Los datos ingresados no son validos";

        if(isset($unUsuario) && Usuario::EscribirUnUsuarioPorCsv($unUsuario,$nombreDeArchivo) !== false)
        {
            $mensaje = "El usuario se guardo exitosamente";
        }
    }


    echo $mensaje;


?>