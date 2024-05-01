<!-- 
Aplicación No 24 ( Listado JSON y array de usuarios)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,etc.),por ahora solo tenemos
usuarios).
En el caso de usuarios carga los datos del archivo usuarios.json.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista.
Hacer los métodos necesarios en la clase usuario
-->
<!-- 
Alumno : Augusto Delgado 
Div : A332
-->

<?php

require_once "C:/xampp/htdocs/ProgIII/Clase_04/eje_24/Usuario.php";

$mensaje = "NO SE RECIBIERON DATOS";
$unUsuario = null ;
$nombreDeArchivo = "usuarios.json";

    if(Usuario::EscribirArrayPorJson(array(new Usuario("pepe","Julio@gmail.com","12345678"),
    new Usuario("mario","mario@gmail.com","12345678"),new Usuario("Pergolino","pergolino@gmail.com","12345678")),$nombreDeArchivo ) !== false)
    {
        $mensaje = " Se Pudo Escribir el archivo";
    }

    echo $mensaje."<br><br>";

    if($_SERVER['REQUEST_METHOD'] == "GET" && $_GET["listado"] == "usuarios.json")
    {
        $listaDeUsuarios = Usuario::LeerJson($nombreDeArchivo,true);
       
        if(isset($listaDeUsuarios))
        {
            $mensaje = "Los Datos leidos en el archivo son<br>".Usuario::MostrarListaDeUsuarioEnHtml($listaDeUsuarios);
        }else{
            $mensaje = " No Se Pudo Leer el archivo";
        }
    }

    echo $mensaje."<br><br>";


?>