
<!-- 

//             3-
// a- DepositoCuenta.php: (por POST) se recibe el Tipo de Cuenta, Nro de Cuenta y
// Moneda y el importe a depositar, si la cuenta existe en banco.json, se incrementa el
// saldo existente según el importe depositado y se registra en el archivo depósitos.json
// la operación con los datos de la cuenta y el depósito (fecha, monto) e id
// autoincremental) .
// Si la cuenta no existe, informar el error.

b- Completar el depósito con imagen del talón de depósito con el nombre: Tipo de
Cuenta, Nro. de Cuenta e Id de Depósito, guardando la imagen en la carpeta
/ImagenesDeDepositos2023.

 -->
<!-- 
    Alumno:Augusto Delgado
    Div A332
 -->
 <?php
require_once 'Clases/Deposito.php';
require_once 'Clases/Usuario.php';
$mensaje = "No se recibieron parametros";
$listaDeUsuario = Usuario::LeerJson("banco.json");

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tipoDeCuenta']) && isset($_POST['numeroDeCuenta']) )
{
    $mensaje = "no existe la cuenta";
   $unUsuario =  Usuario::BuscarUsuarioPorNumeroDeCuenta($listaDeUsuario ,$_POST['numeroDeCuenta']);
   $unDeposito;

   $mensaje = "no se realizar el Deposito";
    if(isset($unUsuario) && ($unDeposito = Deposito::ObtenerUnDepositoPorArrayAsosiativo($_POST)) != null)
    {
        $unDeposito->SetImagen($_FILES['imagen']['tmp_name'],$_FILES['imagen']['name']);
        $unDeposito->MoverImagen("ImagenesDeDepositos2023/");
        array_push($listaDeDeposito,$unDeposito);
        Deposito::EscribirDepositoEnArrayJson($listaDeDeposito,' depositos.json');
        $mensaje = "Se realizo el Deposito: <br>".$unDeposito->ToString();;
    }
}

echo $mensaje ;

?>