<!-- Aplicación No 21 ( Listado CSV y array de usuarios)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
usuarios).
En el caso de usuarios carga los datos del archivo usuarios.csv.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista

<ul>
<li>Coffee</li>
<li>Tea</li>
<li>Milk</li>
</ul>
Hacer los métodos necesarios en la clase usuario 



Alumno : Augusto Delgado 
Div : A332
-->

<?php

require_once "./Usuario.php";

$unUsuario = null ;
$mensaje = "No Se Pudo Leer el archivo";
$nombreDeArchivo = "usuarios.csv";
$listaDeUsuario = array(new Usuario("pepe","Julio@gmail.com","12345678"),new Usuario("juan","Jul@gmail.com","12345658"),
                    new Usuario("Mario","Juju@gmail.com","laClaves"),new Usuario("james","james@gmail.com","Claveses"));

    // var_dump($_GET["listado"]);

    if(Usuario::EscribirArrayPorCsv($listaDeUsuario,$nombreDeArchivo ) !== false)
    {
        $mensaje = " Se Pudo Escribir el archivo";
    }

    if($_server["REQUEST_METHOD"] == "GET" && $_GET["listado"] == "usuarios")
    {
        echo $mensaje."<br><br>";

        $listaDeUsuarios = Usuario::LeerCsv($nombreDeArchivo );

        if(isset($listaDeUsuarios))
        {
            $mensaje = "Los Datos leidos en el archivo son<br>".Usuario::MostrarListaDeUsuarioEnHtml($listaDeUsuarios);
        }else{
            $mensaje = " No Se Pudo Leer el archivo";
        }
    }

    echo $mensaje."<br><br>";

?>