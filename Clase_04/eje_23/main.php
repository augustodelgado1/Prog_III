<!-- Aplicación No 23 (Registro JSON)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un dato con la
fecha de registro , toma todos los datos y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
Usuario/Fotos/.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario. 
-->

<!-- 
Alumno : Augusto Delgado 
Div : A332
-->

<?php

require_once "Usuario.php";

$carpetasArchivos = "./Usuario/Fotos/";
$unUsuario = null;

$nombreDeArchivo = "usuarios.json";
$mensaje = "El Directorio ya existe";

if(File::CrearUnDirectorio("./Usuario") 
&& File::CrearUnDirectorio("./Usuario/Fotos"))
{
    $mensaje = "Se Creo El directorio en donde se va guardar el archivo";
}

echo $mensaje."<br><br>";

$mensaje = "No se recibieron datos";

if($_SERVER['REQUEST_METHOD'] == 'POST' && 
($unUsuario = Usuario::CrearUsuario($_POST['nombre'],$_POST['mail'],$_POST['clave'])) !== null)
{
    $mensaje = "No se pudo dar de alta el usuario";

    if( Usuario::EscribirArrayPorJson(array($unUsuario),$nombreDeArchivo) !== false 
    && $unUsuario->MoverFoto($_FILES['imagen']['tmp_name'],$carpetasArchivos,$_FILES['imagen']['name']) !== false )
    {
        $mensaje = "El Usuario Se subio perfectamente";
    }
}

echo $mensaje;




?>