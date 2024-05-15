

<?php

require_once 'File.php';
class Devolucion
{
    private $id;
    private $imagen;
    private $rutaDeLafoto;
    private $causa;

    public function __construct($causa,$ruta = null,$imagen = null) {
        $this->causa = $causa;
        $this->SetImagen($ruta,$imagen);
        $this->id = Devolucion::ObtenerIdAutoIncremental();
    }

    private static function ObtenerIdAutoIncremental()
    {
        return rand(1,10000);
    }

    public function GetId()
    {
        return $this->id;
    }

    private function SetImagen($ruta,$nombreDelaImagen)
    {
        $estado = false;
        if(isset($ruta) && isset($nombreDelaImagen))
        {
            $this->imagen = $nombreDelaImagen;
            $this->rutaDeLafoto = $ruta;
            $estado = true;
        }

        return $estado;
    }

    public function ModificarFoto($nuevaRuta,$nombreDelaImagen)
    {
        $estado = false;
        if(File::MoverFoto($this->rutaDeLafoto,$nuevaRuta,$nombreDelaImagen))
        {
            $this->SetImagen($nuevaRuta,$nombreDelaImagen);
            $estado = true;
        }

        return $estado;
    }

    public static function EscribirDevolucionEnArrayJson($listaDeDevolucions,$nombreDeArchivo)
    {
        $estado = false; 
        $listaDeArrayAsosiativos = null;

        if(isset($listaDeDevolucions) 
        && ($listaDeArrayAsosiativos = Devolucion::SerializarListaJson($listaDeDevolucions)) !== null)
        {
            $estado =  File::EscribirEnArrayJson($listaDeArrayAsosiativos,$nombreDeArchivo);
        }
        return  $estado;
    }

    private static function SerializarListaJson($listaDeDevolucions)
    {
        $listaDeArrayAsosiativos = null; 

        if(isset($listaDeDevolucions))
        {
            $listaDeArrayAsosiativos = [];

            foreach($listaDeDevolucions as $unDevolucion)
            {
               
                array_push($listaDeArrayAsosiativos,$unDevolucion->ObtenerDatos());
            }
        }

        return  $listaDeArrayAsosiativos ;
    }

    private function ObtenerDatos()
    {
        return array(
            'imagen' => $this->imagen,
            'rutaDeLafoto' => $this->rutaDeLafoto,
            'causa' => $this->causa,
            'id' => $this->id,
        );
    }

    public static function LeerJson($nombreDeArchivo)
    {
        return Devolucion::DeserializarListaJson(File::LeerListaJson($nombreDeArchivo,true));
    }

    private static function DeserializarListaJson($listaDeArrayAsosiativos)
    {
        $listaDeDevolucions = null; 

        if(isset($listaDeArrayAsosiativos))
        {
            $listaDeDevolucions = [];

            foreach($listaDeArrayAsosiativos as $unArrayAsosiativo)
            {
                array_push($listaDeDevolucions,Devolucion::ObtenerUnaDevolucionPorArrayAsosiativo($unArrayAsosiativo));
            }
        }

        return  $listaDeDevolucions ;
    }

    public static function ObtenerUnaDevolucionPorArrayAsosiativo($unArrayAsosiativo)
    {
        $unaDevolucion = null;

        if(isset($unArrayAsosiativo))
        {
            $unaDevolucion = new Devolucion($unArrayAsosiativo['causa'],$unArrayAsosiativo['rutaDeLafoto'],$unArrayAsosiativo['imagen']);

            $unaDevolucion->SetId($unArrayAsosiativo['id']);
        }
        
        return $unaDevolucion;
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

       public function ToString()
    {
        return "causa: ".$this->causa.'<br>';
    }
    public static function ToStringList($listaDeDevolucion)
    {
        $strLista = null; 

        if(isset($listaDeDevolucion) )
        {
            foreach($listaDeDevolucion as $unaDevolucion)
            {
                $strLista = $unaDevolucion->ToString().'<br>';
            }
        }

        return   $strLista;
    }

    public static function BuscarDevolucionPorId($listaDeDevolucion,$id)
    {
        $index = -1;
        $leght = count($listaDeDevolucion); 
        if(isset($listaDeDevolucion)  && $leght > 0)
        {
            for ($i=0; $i < $leght; $i++) { 
         
                if( $listaDeDevolucion[$i]->id == $id)
                {
                    $index = $i;
                    break;
                }
            }
        }

        return $index;
    }

    

   

    



    
 
}


?>