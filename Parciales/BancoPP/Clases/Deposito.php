

<?php

require_once 'Clases/File.php';
class Deposito
{
    private $id;
    private $unUsuario;
    private $importe; 
    private $fechaDeRegistro;
    private $rutaDeLaImagen;
    private $nombreDeLaImagen;

    

    public function __construct($unUsuario,$importe,$ruta = null,$numeroDeCuentaDeLaImagen = null) {
        $this->unUsuario = $unUsuario;
        $this->importe = $importe;
        $this->fechaDeRegistro = date("Y-m-d");
        $this->id = Deposito::ObtenerIdAutoIncremental();
    }

//     b- Completar el depósito con imagen del talón de depósito con el nombre: Tipo de
// Cuenta, Nro. de Cuenta e Id de Depósito, guardando la imagen en la carpeta
// /ImagenesDeDepositos2023.
    public function SetImagen($ruta,$nombreDelaImagen)
    {
        $estado = false;
        if(isset($ruta) && isset($nombreDelaImagen))
        {
            $this->nombreDeLaImagen = $this->unUsuario->GetNumeroDeCuenta().$this->unUsuario->GetTipoDeCuenta().$this->id.$nombreDelaImagen;
            $this->rutaDeLaImagen = $ruta;
            $estado = true;
        }

        return $estado;
    }

    public function MoverImagen($nuevaRuta)
    {
        $estado = false;
        if(File::MoverFoto($this->rutaDeLaImagen,$nuevaRuta,$this->nombreDeLaImagen))
        {
            $this->rutaDeLaImagen = $nuevaRuta;
            $estado = true;
        }

        return $estado;
    }

    public function GetImporte()
    {
        return  $this->importe;
    }

    public function ActualizarImporte($importe)
    {
        $estado = false;

        if(isset($importe) && $importe > 0)
        {
            $this->unUsuario->ActualizarSaldo($this->unUsuario->getSaldo() + $importe);
            $estado = true;
        }

        return $estado;
    }

    private static function ObtenerIdAutoIncremental()
    {
        return rand(1,10000);
    }

    public static function EscribirDepositoEnArrayJson($listaDeDeposito,$numeroDeCuentaDeArchivo)
    {
        $estado = false; 
        $listaDeArrayAsosiativos = null;

        if(isset($listaDeDeposito) 
        && ($listaDeArrayAsosiativos = Deposito::SerializarListaJson($listaDeDeposito)) !== null)
        {
            $estado =  File::EscribirEnArrayJson($listaDeArrayAsosiativos,$numeroDeCuentaDeArchivo);
        }
        return  $estado;
    }

    private static function SerializarListaJson($listaDeDeposito)
    {
        $listaDeArrayAsosiativos = null; 

        if(isset($listaDeDeposito))
        {
            $listaDeArrayAsosiativos = [];

            foreach($listaDeDeposito as $unDeposito)
            {
                array_push($listaDeArrayAsosiativos,$unDeposito->ObtenerDatos());
            }
        }

        return  $listaDeArrayAsosiativos ;
    }

    private function ObtenerDatos()
    {
        return array(
            'numeroDeCuenta' => $this->unUsuario,
            'importe' => $this->importe,
            'id' => $this->id,
        );
    }
   
    public static function LeerJson($numeroDeCuentaDeArchivo)
    {
        return Deposito::DeserializarListaJson(File::LeerListaJson($numeroDeCuentaDeArchivo,true));
    }

    private static function DeserializarListaJson($listaDeArrayAsosiativos)
    {
        $listaDeDeposito = null; 

        if(isset($listaDeArrayAsosiativos))
        {
            $listaDeDeposito = [];

            foreach($listaDeArrayAsosiativos as $unArrayAsosiativo)
            {
                array_push($listaDeDeposito,Deposito::ObtenerUnDepositoPorArrayAsosiativo($unArrayAsosiativo));
            }
        }

        return  $listaDeDeposito ;
    }

    public static function ObtenerUnDepositoPorArrayAsosiativo($unArrayAsosiativo)
    {
        $unDeposito = null;

        if(isset($unArrayAsosiativo) && isset($unArrayAsosiativo['mail'])
        && isset($unArrayAsosiativo['numeroDeCuenta']) && isset($unArrayAsosiativo['clave'])
        && isset($unArrayAsosiativo['importe']))
        {
            $unDeposito = new Deposito($unArrayAsosiativo['mail'],
            $unArrayAsosiativo['clave'],$unArrayAsosiativo['numeroDeCuenta'],
            $unArrayAsosiativo['importe']);
            $unDeposito->SetId( $unArrayAsosiativo['id']);
        }
        
        return $unDeposito;
    }

    private function SetId($id)
    {
        $estado = false;
        if(isset($id))
        {
            $this->id = $id;
            $estado = true;
        }

        return  $estado ;
    }
    public static function BuscarUnaDepositoPorId($listaDeDeposito,$id)
    {
        $index = -1;
        $leght = count($listaDeDeposito); 
        if(isset($listaDeDeposito)  && $leght > 0  && isset($id))
        {
            for ($i=0; $i < $leght; $i++) { 
         
                if($listaDeDeposito[$i]->id == $id)
                {
                    $index = $i;
                    break;
                }
            }
        }

        return $index;
    }



    public static function BuscarDepositoPorId($listaDeDeposito,$id)
    {
        $unaDepositoABuscar = null; 

        if(isset($listaDeDeposito)  
        && isset($id) )
        {
            foreach($listaDeDeposito as $unaDeposito)
            {
                if($unaDeposito->id == $id)
                {
                    $unaDepositoABuscar = $unaDeposito; 
                    break;
                }
            }
        }

        return  $unaDepositoABuscar;
    }

    public function ToString()
    {
        return "numeroDeCuenta: ".$this->unUsuario.'<br>'
        ."importe: ".$this->importe.'<br>'
        ."fechaDeRegistro: ".self::$fechaDeRegistro.'<br>' 
        ."id: ". $this->id;
    }
    public static function ToStringList($listaDeDeposito)
    {
        $strLista = null; 

        if(isset($listaDeDeposito) )
        {
            foreach($listaDeDeposito as $unaDeposito)
            {
                $strLista = $unaDeposito->ToString().'<br>';
            }
        }

        return   $strLista;
    }
}


?>