

<?php
require_once 'Clases/File.php';
class Clase implements JsonSerializable
{
   
    private $id;
    private $nombre;
    private $apellido; 
    private $clave;
    private $mail;
    private $fechaDeRegistro;
    private $rutaDeLaImagen;
    private $nombreDeLaImagen;


    public function __construct($mail,$clave,$nombre,$apellido,$ruta = null,$nombreDeLaImagen = null) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->mail = $mail;
        $this->clave = $clave;
        $this->fechaDeRegistro = date("Y-m-d");
        $this->SetId(Clase::ObtenerIdAutoIncremental());
        $this->SetImagen($ruta,$nombreDeLaImagen);
    }

    public function GetApellido()
    {
        return  $this->apellido;
    }

    public function ActualizarApellido($apellido)
    {
        $estado = false;
        if(isset($apellido) && $apellido > 0 )
        {
            $this->apellido = $apellido ;
            $estado = true;
        }

        return $estado;
    }
    public function SetImagen($ruta,$nombreDelaImagen)
    {
        $estado = false;
        if(isset($ruta) && isset($nombreDelaImagen))
        {
            $this->nombreDeLaImagen = $this->nombre.$this->tipo.$nombreDelaImagen;
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

    private static function ObtenerIdAutoIncremental()
    {
        return rand(1,10000);
    }

    public static function EscribirClaseEnArrayJson($listaDeClases,$nombreDeArchivo)
    {
        $estado = false; 

        if(isset($listaDeClases))
        {
            $estado =  File::EscribirEnArrayJson($listaDeClases,$nombreDeArchivo);
        }
        return  $estado;
    }

    public function jsonSerialize()
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
        $unClase = null;
        if(isset($listaDeArrayAsosiativos))
        {
            $listaDeClases = [];

            foreach($listaDeArrayAsosiativos as $unArrayAsosiativo)
            {
                $unClase = Clase::ObtenerUnClasePorArrayAsosiativo($unArrayAsosiativo);
                if(isset($unClase))
                {
                    array_push($listaDeClases,);
                }
                
            }
        }

        return  $listaDeClases ;
    }

    public static function ObtenerUnClasePorArrayAsosiativo($unArrayAsosiativo)
    {
        $unClase = null;

        if(isset($unArrayAsosiativo) && isset($unArrayAsosiativo['mail'])
        && isset($unArrayAsosiativo['nombre']) && isset($unArrayAsosiativo['clave'])
        && isset($unArrayAsosiativo['apellido']))
        {
            $unClase = new Clase($unArrayAsosiativo['mail'],
            $unArrayAsosiativo['clave'],$unArrayAsosiativo['nombre'],
            $unArrayAsosiativo['apellido']);
            $unClase->SetId( $unArrayAsosiativo['id']);
        }
        
        return $unClase;
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
    public static function BuscarUnaClasePorId($listaDeClases,$id)
    {
        $index = -1;
        $leght = count($listaDeClases); 
        if(isset($listaDeClases)  && $leght > 0  && isset($id))
        {
            for ($i=0; $i < $leght; $i++) { 
         
                if($listaDeClases[$i]->id == $id)
                {
                    $index = $i;
                    break;
                }
            }
        }

        return $index;
    }



    public static function BuscarClasePorId($listaDeClase,$id)
    {
        $unaClaseABuscar = null; 

        if(isset($listaDeClase)  
        && isset($id) )
        {
            foreach($listaDeClase as $unaClase)
            {
                if($unaClase->id == $id)
                {
                    $unaClaseABuscar = $unaClase; 
                    break;
                }
            }
        }

        return  $unaClaseABuscar;
    }

    public function ToString()
    {
        return "nombre: ".$this->nombre.'<br>'
        ."apellido: ".$this->apellido.'<br>'
        ."mail: ".$this->mail.'<br>'
        ."clave: ".$this->clave.'<br>'
        ."fechaDeRegistro: ".$this->fechaDeRegistro.'<br>' 
        ."id: ". $this->id;
    }
    public static function ToStringList($listaDeClase)
    {
        $strLista = null; 

        if(isset($listaDeClase) )
        {
            foreach($listaDeClase as $unaClase)
            {
                $strLista = $unaClase->ToString().'<br>';
            }
        }

        return   $strLista;
    }
}


?>