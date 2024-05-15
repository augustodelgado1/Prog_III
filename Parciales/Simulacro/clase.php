

<?php

require_once 'File.php';
class Clase
{
    private $id;
    private $nombre;
    private $apellido; 
    private $clave;
    private $mail;
    private $fechaDeRegistro;

    public function __construct($mail,$clave,$nombre,$apellido) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->mail = $mail;
        $this->clave = $clave;
        $this->fechaDeRegistro = date("Y-m-d");
        $this->id = Clase::ObtenerIdAutoIncremental();
    }

    private static function ObtenerIdAutoIncremental()
    {
        return rand(1,10000);
    }

    public static function EscribirClaseEnArrayJson($listaDeClases,$nombreDeArchivo)
    {
        $estado = false; 
        $listaDeArrayAsosiativos = null;

        if(isset($listaDeClases) 
        && ($listaDeArrayAsosiativos = Clase::SerializarListaJson($listaDeClases)) !== null)
        {
            $estado =  File::EscribirEnArrayJson($listaDeArrayAsosiativos,$nombreDeArchivo);
        }
        return  $estado;
    }

    private static function SerializarListaJson($listaDeClases)
    {
        $listaDeArrayAsosiativos = null; 

        if(isset($listaDeClases))
        {
            $listaDeArrayAsosiativos = [];

            foreach($listaDeClases as $unClase)
            {
                array_push($listaDeArrayAsosiativos,$unClase->ObtenerDatos());
            }
        }

        return  $listaDeArrayAsosiativos ;
    }

    private function ObtenerDatos()
    {
        return array(
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'clave' => $this->clave,
            'mail' => $this->mail,
            'id' => $this->id,
        );
    }
   
    public static function LeerJson($nombreDeArchivo)
    {
        return Clase::DeserializarListaJson(File::LeerListaJson($nombreDeArchivo,true));
    }

    private static function DeserializarListaJson($listaDeArrayAsosiativos)
    {
        $listaDeClases = null; 

        if(isset($listaDeArrayAsosiativos))
        {
            $listaDeClases = [];

            foreach($listaDeArrayAsosiativos as $unArrayAsosiativo)
            {
                array_push($listaDeClases,Clase::ObtenerUnaClasePorArrayAsosiativo($unArrayAsosiativo));
            }
        }

        return  $listaDeClases ;
    }

    public static function ObtenerUnaClasePorArrayAsosiativo($unArrayAsosiativo)
    {
        $unaClase = null;

        if(isset($unArrayAsosiativo))
        {
            $unaClase = new Clase($unArrayAsosiativo['nombre'],
            $unArrayAsosiativo['apellido'],$unArrayAsosiativo['clave'],
            $unArrayAsosiativo['mail']);
            $unaClase->SetId( $unArrayAsosiativo['id']);
        }
        
        return $unaClase;
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

    public static function BuscarUnaClasePorNumeroDePedido($listaDeClases,$id)
    {
        $index = -1;
        $leght = count($listaDeClases); 
        if(isset($listaDeClases)  && $leght > 0)
        {
            for ($i=0; $i < $leght; $i++) { 
         
                if( $listaDeClases[$i]->id == $id)
                {
                    $index = $i;
     
                    break;
                }
            }
        }

        return $index;
    }



    // public static function BuscarClasePorId($listaDeClase,$id)
    // {
    //     $unaClaseABuscar = null; 

    //     if(isset($listaDeClase) )
    //     {
    //         foreach($listaDeClase as $unaClase)
    //         {
    //             if($unaClase->id == $id)
    //             {
    //                 $unaClaseABuscar = $unaClase; 
    //                 break;
    //             }
    //         }
    //     }

    //     return  $unaClaseABuscar;
    // }

    // public function ToString()
    // {
    //     return "nombre: ".$this->nombre.'<br>'
    //     ."apellido: ".$this->apellido.'<br>'
    //     ."mail: ".$this->mail.'<br>'
    //     ."clave: ".$this->clave.'<br>'
    //     ."fechaDeRegistro: ".self::$fechaDeRegistro.'<br>' 
    //     ."id: ". $this->id;
    // }
    // public static function ToStringList($listaDeClase)
    // {
    //     $strLista = null; 

    //     if(isset($listaDeClase) )
    //     {
    //         foreach($listaDeClase as $unaClase)
    //         {
    //             $strLista = $unaClase->ToString().'<br>';
    //         }
    //     }

    //     return   $strLista;
    // }
}


?>