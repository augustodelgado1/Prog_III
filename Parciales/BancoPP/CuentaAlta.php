
<!-- 


//           B- CuentaAlta.php: (por POST) se ingresa Nombre y Apellido, Tipo Documento, Nro.
// Documento, Email, Tipo de Cuenta (CA – caja de ahorro o CC – cuenta corriente),
// Moneda ($ o U$S), Saldo Inicial (0 por defecto).
// NOTA: los números de cuenta son únicos dentro del Banco, considerando para
// evaluarlos que la cuenta está compuesta por tipo de cuenta (CA o CC), nro. de cuenta y
// moneda.
// Se guardan los datos en el archivo banco.json, tomando un id autoincremental de 6
// dígitos como Nro. de Cuenta (emulado). Sí el número y tipo ya existen, se actualiza el
// saldo existente.
// completar el alta con imagen/foto del usuario/cliente, guardando la imagen con Nro y
// Tipo de Cuenta (ej.: NNNNNNTT) como identificación en la carpeta:
// /ImagenesDeCuentas/2023.

 -->
<!-- 
    Alumno:Augusto Delgado
    Div A332
 -->
<?php
require_once 'Clases/Usuario.php';
$mensaje = "No se recibieron parametros";
$listaDeUsuario = Usuario::LeerJson("banco.json");



if(!isset($listaDeUsuario )  )
{
    $listaDeUsuario = array();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' 
&& isset($_POST['numeroDeDocumento']) 
&& isset($_POST['tipoDeCuenta']))
{
    $mensaje = "no existe";
  
    $unUsuario = Usuario::BuscarUsuarioPorNumeroDeCuenta($listaDeUsuario ,$_POST['numeroDeCuenta']);

    if(isset($unUsuario) 
    && $unUsuario->GetTipoDeCuenta() == $_POST['tipoDeCuenta'] 
&& $unUsuario->ActualizarSaldo($_POST['saldo']))
    {
        $mensaje = "Se actualizo el saldo";
        $unUsuario->CambiarRutaDeLaImagen("ImagenesDeCuentas/Actualizadas/");

    }else{
        $mensaje = "no se pudo dar de alta";
        if(($unUsuario = Usuario::ObtenerUnaUsuarioPorArrayAsosiativo($_POST)) != null)
        {
            $unUsuario->GuardarImagen($_FILES['imagen']['tmp_name'],"ImagenesDeCuentas/2023/",$_FILES['imagen']['name']);
            array_push($listaDeUsuario,$unUsuario);
            Usuario::EscribirUsuarioEnArrayJson($listaDeUsuario,'banco.json');
            $mensaje = "Se creo el Usuario: <br>".$unUsuario->ToString();;
        }
    }
    
}

echo $mensaje ;

?>