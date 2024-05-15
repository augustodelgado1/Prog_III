<!-- cupón de descuento (id, devolucion_id, porcentajeDescuento,
estado[usado/no usado])  -->



<?php
require_once 'File.php';
class CuponDescuento
{
    private  $id;
    private $devolucion_id;
    private $porcentajeDescuento; 
    private $estado;

    public function __construct($devolucion_id,$porcentajeDescuento) {
        $this->devolucion_id = $devolucion_id;
        $this->porcentajeDescuento = $porcentajeDescuento;
        $this->estado = false;
        $this->id = CuponDescuento::ObtenerIdAutoIncremental();
    }

    public function GetPorcentajeDescuento()
    {
        return $this->porcentajeDescuento; 
    }

    private static function ObtenerIdAutoIncremental()
    {
        return rand(1,10000);
    }

    public static function EscribirCuponDescuentoEnArrayJson($listaDeCuponDescuentos,$nombreDeArchivo)
    {
        $estado = false; 
        $listaDeArrayAsosiativos = null;

        if(isset($listaDeCuponDescuentos) 
        && ($listaDeArrayAsosiativos = CuponDescuento::SerializarListaJson($listaDeCuponDescuentos)) !== null)
        {
            $estado =  File::EscribirEnArrayJson($listaDeArrayAsosiativos,$nombreDeArchivo);
        }
        return  $estado;
    }

    private static function SerializarListaJson($listaDeCuponDescuentos)
    {
        $listaDeArrayAsosiativos = null; 

        if(isset($listaDeCuponDescuentos))
        {
            $listaDeArrayAsosiativos = [];

            foreach($listaDeCuponDescuentos as $unCuponDescuento)
            {
                array_push($listaDeArrayAsosiativos,$unCuponDescuento->ObtenerDatos());
            }
        }

        return  $listaDeArrayAsosiativos ;
    }

    private function ObtenerDatos()
    {
        return array(
            'devolucionid' => $this->devolucion_id,
            'porcentajeDescuento' => $this->porcentajeDescuento,
            'estado' => $this->estado,
            'id' => $this->id,
        );
    }

    public static function LeerJson($nombreDeArchivo)
    {
        return CuponDescuento::DeserializarListaJson(File::LeerListaJson($nombreDeArchivo,true));
    }

    private static function DeserializarListaJson($listaDeArrayAsosiativos)
    {
        $listaDeCuponDecuentos = null; 

        if(isset($listaDeArrayAsosiativos))
        {
            $listaDeCuponDecuentos = [];

            foreach($listaDeArrayAsosiativos as $unArrayAsosiativo)
            {
                array_push($listaDeCuponDecuentos,CuponDescuento::ObtenerUnaCuponDecuentoPorArrayAsosiativo($unArrayAsosiativo));
            }
        }

        return  $listaDeCuponDecuentos ;
    }

    public static function ObtenerUnaCuponDecuentoPorArrayAsosiativo($unArrayAsosiativo)
    {
        $unaCuponDecuento = null;

        if(isset($unArrayAsosiativo))
        {
            $unaCuponDecuento = new CuponDescuento($unArrayAsosiativo['devolucionid'],$unArrayAsosiativo['porcentajeDescuento']);
            $unaCuponDecuento->SetId($unArrayAsosiativo['id']);
            $unaCuponDecuento->SetEstado($unArrayAsosiativo['estado']);
        }
        
        return $unaCuponDecuento;
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

    private function SetEstado($estado)
    {
        $estadoDeLaFuncion = false;
        if(isset($estado))
        {
          
            $this->estado = $estado;
            $estadoDeLaFuncion = true;
        }

        return  $estadoDeLaFuncion ;
    }

    public function ToString()
    {
        $estado = "usado";
        if($this->estado == false)
        {
            $estado = "no usado";
        }
        
        return
        "porcentajeDescuento: ".$this->porcentajeDescuento.'<br>'
        ."estado: ".$estado.'<br>';
    }


    public static function ToStringList($listaDeCupones)
    {
        $strLista = null; 

        if(isset($listaDeCupones) &&  count($listaDeCupones) > 0)
        {
            foreach($listaDeCupones as $unCupon)
            {
                $strLista = $unCupon->ToString().'<br>';
            }
        }

        return   $strLista;
    }

    public static function BuscarCuponDescuentoPorId($listaDeCuponDescuento,$id)
    {
        $unaCuponDescuentoABuscar = null; 

        if(isset($listaDeCuponDescuento) )
        {
            foreach($listaDeCuponDescuento as $unaCuponDescuento)
            {
                if($unaCuponDescuento::$id == $id)
                {
                    $unaCuponDescuentoABuscar = $unaCuponDescuento; 
                    break;
                }
            }
        }

        return  $unaCuponDescuentoABuscar;
    }

    public static function FiltrarPorEstados($listaDeCupones,$estado)
    {
        $listaDeEstadosDeCupones = null;

        if(isset($listaDeCupones) && isset($estado) && count($listaDeCupones) > 0)
        {
            $listaDeEstadosDeCupones =  [];

            foreach($listaDeCupones as $unCupon)
            {
                if($unCupon->estado == $estado)
                {
                    array_push($listaDeEstadosDeCupones,$unCupon);
                }
            }
        }

        return  $listaDeEstadosDeCupones;
    }

    public static function MostrarDevolucionesConCupones($listaDeDevolucion,$listaDeCupones)
    {
        $strLista = null; 

        if(isset($listaDeDevolucion) && isset($listaDeCupones) )
        {
            foreach($listaDeCupones as $unCupon)
            {
                $index = Devolucion::BuscarDevolucionPorId($listaDeDevolucion, $unCupon->devolucion_id);
                if( $index  >= 0 && $index < count($listaDeDevolucion))
                {
                    $strLista = "Devolucion: ".'<br>'.$listaDeDevolucion[$index]->ToString().'<br>'.
                    "Cupon de Descuento: ".$unCupon->ToString().'<br>';
                }
            }
        }

        return  $strLista;
    }



    


   

    // public function ToString()
    // {
    //     return "devolucion_id: ".$this->devolucion_id.'<br>'
    //     ."porcentajeDescuento: ".$this->porcentajeDescuento.'<br>'
    //     ."estado: ".$this->estado.'<br>'
    //     ."clave: ".$this->clave.'<br>'
    //     ."localidad: ".$this->localidad.'<br>'
    //     ."fechaDeRegistro: ".self::$fechaDeRegistro.'<br>' 
    //     ."id: ". self::$id;
    // }
    // public static function ToStringList($listaDeCuponDescuento)
    // {
    //     $strLista = null; 

    //     if(isset($listaDeCuponDescuento) )
    //     {
    //         foreach($listaDeCuponDescuento as $unaCuponDescuento)
    //         {
    //             $strLista = $unaCuponDescuento->ToString().'<br>';
    //         }
    //     }

    //     return   $strLista;
    // }

    // public static function ObtenerUnaCuponDescuentoPorArrayAsosiativo($unArrayAsosiativo)
    // {
    //     $unaCuponDescuento = null;

    //     if(isset($unArrayAsosiativo))
    //     {
    //         $unaCuponDescuento = new Helado($unArrayAsosiativo['devolucion_id'],
    //         $unArrayAsosiativo['porcentajeDescuento'],$unArrayAsosiativo['clave'],
    //         $unArrayAsosiativo['estado'],$unArrayAsosiativo['localidad']);
    //     }
        
    //     return $unaCuponDescuento;
    // }
}


?>