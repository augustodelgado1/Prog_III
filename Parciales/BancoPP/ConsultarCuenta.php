
<!-- 
//             2-
// ConsultarCuenta.php: (por POST) Se ingresa Tipo y Nro. de Cuenta, si coincide con
// algún registro del archivo banco.json, retornar la moneda/s y saldo de la cuenta/s. De
// lo contrario informar si no existe la combinación de nro y tipo de cuenta o, si existe el
// número y no el tipo para dicho número, el mensaje: “tipo de cuenta incorrecto”.

 -->
<!-- 
    Alumno:Augusto Delgado
    Div A332
 -->
 <?php
require_once 'Clases/Usuario.php';
$mensaje = "No se recibieron parametros";
$listaDeUsuario = Usuario::LeerJson("banco.json");
$estadoDelTipo = null;

if($_SERVER['REQUEST_METHOD'] == 'POST' 
&& isset($_POST['numeroDeDocumento']) 
&& isset($_POST['tipoDeCuenta']))
{
  
    $unUsuario = Usuario::BuscarUsuarioPorNumeroDeCuenta($listaDeUsuario ,$_POST['numeroDeCuenta']);

    if(isset($unUsuario)  && ($estadoDelTipo = ($unUsuario->GetTipoDeCuenta() == $_POST['tipoDeCuenta'])) == true) 
    {
        $mensaje = $unUsuario->MostrarSaldo();

    }else{
        $mensaje = "no existe el numero";
        if(isset($estadoDelTipo)  && $estadoDelTipo  == false)
        {
            $mensaje = "tipo de cuenta incorrecto";
        }
    }
    
}

echo $mensaje;

?>