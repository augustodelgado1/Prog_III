
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


class Venta
{
    private static $id;
    private $unUsuario;
    private $unHelado;
    private $cantidad;
    private static $fechaDeVenta;

   

    public function __construct($unUsuario,$unHelado,$cantidad) {
        $this->unUsuario = $unUsuario;
        $this->unHelado = $unHelado;
        $this->cantidad = $cantidad;
        self::$fechaDeVenta = date("Y-m-d");
        self::$id = rand(1,10000);
    }

//     <!-- 4- (1 pts.)ConsultasVentas.php: (por GET)
// Datos a consultar:
// a- La cantidad de Helados 
// vendidos en un día en particular(se envía por parámetro), si no se pasa fecha, se
// muestran las del día de ayer.
// b- El listado de ventas de un usuario ingresado.
// c- El listado de ventas entre dos fechas ordenado por nombre.
// d- El listado de ventas por sabor ingresado.
// e- El listado de ventas por vaso Cucurucho. -->

// a- La cantidad de Helados 
// vendidos en un día en particular(se envía por parámetro), si no se pasa fecha, se
// muestran las del día de ayer.
// date('Y-m-d ', strtotime('yesterday'));
    public static function FiltrarPorUnaFecha($listaDeVenta,$fecha)
    {
        $filtraPorUnaFecha = null;

        if(isset($listaDeVenta) && isset($fecha) && count($listaDeVenta) > 0)
        {
            $filtraPorUnaFecha =  [];

            foreach($listaDeVenta as $unaVenta)
            {
                if($unaVenta::$fechaDeVenta == $fecha )
                {
                    array_push($filtraPorUnaFecha,$unaVenta);
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

    public static function ObetenerListaDeUsuarioVendidos($listaDeVenta)
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

    // e- El listado de ventas por vaso Cucurucho.


    public static function EscribirVentaEnArrayJson($listaDeVentas,$nombreDeArchivo)
    {
        $estado = false; 
        $unArchivo = fopen($nombreDeArchivo,"w");
        $listaDeArrayAsosiativos = null;

        if(isset($listaDeVentas) && isset($unArchivo)
        && ($listaDeArrayAsosiativos = Venta::SerializarListaJson($listaDeVentas)) !== null)
        {
            $estado = fwrite($unArchivo, json_encode( $listaDeArrayAsosiativos));
        }

        return  $estado ;
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

    public function MoverFoto($tmpNombre,$rutaASubir,$nombreDeArchivo)
    {
        $estado = false;
       
        if(isset($tmpNombre) && isset($rutaASubir))
        {
            var_dump($nombreDeArchivo);
            $rutaDestino = $rutaASubir .self::$fechaDeVenta.self::$id. $nombreDeArchivo;
            $estado =  move_uploaded_file($tmpNombre,$rutaDestino);
        }

        return $estado;
    }

    public static function CrearUnDirectorio($ruta)
    {
        $estado = false;

        if(!file_exists($ruta)  )
        {
            $estado = mkdir($ruta);
        }

        return $estado;
    }

    private function ObtenerDatos()
    {
        return array(
            'unUsuario' => $this->unUsuario,
            'unHelado' => $this->unHelado,
            'cantidad' => $this->cantidad,
            'fechaDeVenta' => self::$fechaDeVenta,
            'id' => self::$id,
        );
    }

   

    

}

?>