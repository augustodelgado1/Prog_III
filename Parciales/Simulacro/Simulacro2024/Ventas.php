
<!-- 4- (1 pts.)ConsultasVentas.php: (por GET)
Datos a consultar:
a- La cantidad de Helados 
vendidos en un día en particular(se envía por parámetro), si no se pasa fecha, se
muestran las del día de ayer.
b- El listado de ventas de un usuario ingresado.
c- El listado de ventas entre dos fechas ordenado por nombre.
d- El listado de ventas por sabor ingresado.
e- El listado de ventas por vaso Cucurucho. -->
<?php

require_once 'File.php';
class Venta
{
    private  $id;
    private $unUsuario;
    private $unHelado;
    private $cantidad;
    private static $fechaDeVenta;
    private $nombreDeLaImagen;
    private $rutaDeLafoto;
    private $importeFinal;
    private $cuponDeDescuento;
    

    public function __construct($unUsuario,$unHelado,$cantidad,$cuponDeDescuento = null,$ruta = null,$nombreDelaImagen = null) {
        $this->unUsuario = $unUsuario;
        $this->unHelado = $unHelado;
        $this->cantidad = $cantidad;
        self::$fechaDeVenta = date("Y-m-d");
        $this->id = rand(1,10000);
        $this->SetImagen($ruta,$nombreDelaImagen);
        $this->SetCupon($cuponDeDescuento);
    }

    private function SetCupon($cuponDeDescuento)
    {
        $estado = false;
        if(isset($cuponDeDescuento) && $cuponDeDescuento->GetPorcentaje() >= 0)
        {
            $this->cuponDeDescuento = $cuponDeDescuento;
            $this->importeFinal *= (1 - ($cuponDeDescuento->GetPorcentajeDescuento() / 100));
            $estado = true;
        }

        return $estado;
    }

    private function SetImagen($ruta,$nombreDelaImagen)
    {
        $estado = false;
        if(isset($ruta) )
        {
            $this->nombreDeLaImagen = $this->fechaDeVenta.$nombreDelaImagen;
            $this->rutaDeLafoto = $ruta;
            $estado = true;
        }

        return $estado;
    }

    public function ModificarImagen($nuevaRuta,$nombreDelaImagen)
    {
        $estado = false;
        if(File::MoverFoto($this->rutaDeLafoto,$nuevaRuta,$nombreDelaImagen))
        {
            $this->SetImagen($nuevaRuta,$nombreDelaImagen);
            $estado = true;
        }

        return $estado;
    }
   
    public static function ContarPorUnaFecha($listaDeVenta,$fecha)
    {
        $filtraPorUnaFecha = null;
        $cantidad = -1;

        if(isset($listaDeVenta) && isset($fecha))
        {
            $cantidad = 0;

            foreach($listaDeVenta as $unaVenta)
            {
                if($unaVenta::$fechaDeVenta == $fecha)
                {
                    $cantidad++;
                }
            }
        }

        return  $filtraPorUnaFecha;
    }


    public static function FiltrarPorUsuario($listaDeVenta,$unUsuario)
    {
        $listaDeVentasDeUnUsuario = null;

        if(isset($listaDeVenta) && isset($Usuario) && count($listaDeVenta) > 0)
        {
            $listaDeVentasDeUnUsuario =  [];

            foreach($listaDeVenta as $unaVenta)
            {
                if($unaVenta->unUsuario == $unUsuario)
                {
                    array_push($listaDeVentasDeUnUsuario,$unaVenta);
                }
            }
        }

        return  $listaDeVentasDeUnUsuario;
    }

    public function RealizarVenta($unUsuario,$unHelado,$cantidad )
    {
        $unaVenta = null;
        if(isset($unHelado) && isset($unUsuario) && 
        $unHelado->GetStock() > 0 && $cantidad > 0 && $cantidad <= $unHelado->GetStock())
        {
            $unaVenta = new Venta($unUsuario,$unHelado,$cantidad);
        }

        return $unaVenta;
    }

//     c- El listado de ventas entre dos fechas ordenado por nombre.
// d- El listado de ventas por sabor ingresado.
// e- El listado de ventas por vaso Cucurucho.

    public static function FiltrarPorFecha($listaDeVenta,$fechaDesde,$fechaHasta)
    {
        $filtrarPorVenta = null;

        if(isset($listaDeVenta) && isset($Usuario) && count($listaDeVenta) > 0)
        {
            $filtrarPorVenta =  [];
        
            foreach($listaDeVenta as $unaVenta)
            {
                if($unaVenta::$fechaDeVenta <= $fechaDesde && $unaVenta::$fechaDeVenta >= $fechaHasta)
                {
                    array_push($filtrarPorVenta,$unaVenta);
                }
            }
        }

        return  $filtrarPorVenta;
    }

    
    public static function FiltrarPorSaborDeHelado($listaDeVenta,$sabor)
    {
        $filtrarPorVenta = null;

        if(isset($listaDeVenta) && isset($Usuario) && count($listaDeVenta) > 0)
        {
            $filtrarPorVenta =  [];

            foreach($listaDeVenta as $unaVenta)
            {
                if($unaVenta::$helado->GetSabor() == $sabor)
                {
                    array_push($filtrarPorVenta,$unaVenta);
                }
            }
        }

        return  $filtrarPorVenta;
    }

    public static function FiltrarPorVasoDeHelado($listaDeVenta,$vaso)
    {
        $filtrarPorVenta = null;

        if(isset($listaDeVenta) && isset($Usuario) && count($listaDeVenta) > 0)
        {
            $filtrarPorVenta =  [];

            foreach($listaDeVenta as $unaVenta)
            {
                if($unaVenta::$helado->GetVaso() == $vaso)
                {
                    array_push($filtrarPorVenta,$unaVenta);
                }
            }
        }

        return  $filtrarPorVenta;
    }
   

    // d- El listado de ventas por sabor ingresado.
    // e- El listado de ventas por vaso Cucurucho.
    public static function ObetenerListaDeHeladosVendidos($listaDeVenta)
    {
        $listaDeHeladosVendidos = null;

        if(isset($listaDeVenta) && isset($Usuario) && count($listaDeVenta) > 0)
        {
            $listaDeHeladosVendidos =  [];
            
            foreach($listaDeVenta as $unaVenta)
            {
                if(!array_search($listaDeHeladosVendidos,$unaVenta->unHelado))
                {
                    array_push($listaDeHeladosVendidos,$unaVenta->unHelado);
                }
            }
        }

        return  $listaDeHeladosVendidos;
    }

    

    public static function ObtenerListaDeUsuario($listaDeVenta)
    {
        $listaDeUsuarioCompraron = null;

        if(isset($listaDeVenta) && isset($Usuario) && count($listaDeVenta) > 0)
        {
            $listaDeUsuarioCompraron =  [];
            
            foreach($listaDeVenta as $unaVenta)
            {
                if(!array_search($listaDeUsuarioCompraron,$unaVenta->unUsuario))
                {
                    array_push($listaDeUsuarioCompraron,$unaVenta->unUsuario);
                }
            }
        }

        return  $listaDeUsuarioCompraron;
    }

    public static function EscribirVentaEnArrayJson($listaDeVentas,$nombreDeArchivo)
    {
        $estado = false; 
        $listaDeArrayAsosiativos = null;

        if(isset($listaDeVentas) 
        && ($listaDeArrayAsosiativos = Venta::SerializarListaJson($listaDeVentas)) !== null)
        {
            $estado =  File::EscribirEnArrayJson($listaDeArrayAsosiativos,$nombreDeArchivo);
        }
        return  $estado;
    }

    public static function LeerJson($nombreDeArchivo)
    {
        return Venta::DeserializarListaJson(File::LeerListaJson($nombreDeArchivo,true));
    }

    private static function DeserializarListaJson($listaDeArrayAsosiativos)
    {
        $listaDeVentas = null; 

        if(isset($listaDeArrayAsosiativos))
        {
            $listaDeVentas = [];

            foreach($listaDeArrayAsosiativos as $unArrayAsosiativo)
            {
                array_push($listaDeVentas,Venta::ObtenerUnaVentaPorArrayAsosiativo($unArrayAsosiativo));
            }
        }

        return  $listaDeVentas ;
    }

    public static function ObtenerUnaVentaPorArrayAsosiativo($unArrayAsosiativo)
    {
        $unaVenta = null;

        if(isset($unArrayAsosiativo))
        {
            $unaVenta = new Venta($unArrayAsosiativo['email'],
            $unArrayAsosiativo['idDeHelado'],$unArrayAsosiativo['cantidad']);
            $unaVenta->SetId($unArrayAsosiativo['id']);
        }
        
        return $unaVenta;
    }

    private function SetId($id)
    {
        $estado = false;
        if(isset($id))
        {
            var_dump($id);
            $this->id = $id;
            $estado = true;
        }

        return  $estado ;
    }

    public static function BuscarUnaVentaPorNumeroDePedido($listaDeVentas,$id)
    {
        $index = -1;
        $leght = count($listaDeVentas); 
        if(isset($listaDeVentas)  && $leght > 0)
        {
            for ($i=0; $i < $leght; $i++) { 
         
                if( $listaDeVentas[$i]->id == $id)
                {
                    $index = $i;
     
                    break;
                }
            }
        }

        return $index;
    }

    public function Modificar($listaDeVentas,$index)
    {
        $estado = false;

        if(isset($listaDeVentas)  && $index >= 0)
        {
            $listaDeVentas[$index] = $this;
            $estado = true;
        }

        return $estado;
    }
    public static function Borrar($listaDeVentas,$index)
    {
        $estado = false;

        if(isset($listaDeVentas) && $index >= 0)
        {
            $listaDeVentas[$index]->ModificarFoto("ImagenesBackupVentas/2024/",$listaDeVentas[$index]->nombreDeLaImagen);
            array_splice($listaDeVentas,$index,1);
            $estado = true;
        }

        return $estado;
    }

    

    //Serializar
    private static function SerializarListaJson($listaDeVentas)
    {
        $listaDeArrayAsosiativos = null; 

        if(isset($listaDeVentas))
        {
            $listaDeArrayAsosiativos = [];

            foreach($listaDeVentas as $unVenta)
            {
                array_push($listaDeArrayAsosiativos,$unVenta->ObtenerDatos());
            }
        }

        return  $listaDeArrayAsosiativos ;
    }

    public static function recortarHastaCaracter($cadena, $caracter) {
       
        $nuevoStr = null;

        if(($posicion = strpos($cadena, $caracter)) !== false)
        {
            $nuevoStr = substr($cadena, 0, $posicion);
        }

        return $nuevoStr;
    }
    private function ObtenerDatos()
    {
        return array(
            'unUsuario' => $this->unUsuario,
            'unHelado' => $this->unHelado,
            'cantidad' => $this->cantidad,
            'fechaDeVenta' => self::$fechaDeVenta,
            'id' => $this->id,
            'importeFinal' => $this->importeFinal,
        );
    }

    public function ToString()
    {
        return "unUsuario: ".$this->unUsuario.'<br>'
        ."unHelado: ".$this->unHelado.'<br>'
        ."cantidad: ".$this->cantidad.'<br>'
        ."fechaDeVenta: ".self::$fechaDeVenta.'<br>' 
        ."id: ". $this->id;
    }
    public static function StrListaVenta($listaDeVenta)
    {
        $strLista = null; 

        if(isset($listaDeVenta) )
        {
            foreach($listaDeVenta as $unaVenta)
            {
                $strLista = $unaVenta->ToString().'<br>';
            }
        }

        return   $strLista;
    }

   

    

}

?>