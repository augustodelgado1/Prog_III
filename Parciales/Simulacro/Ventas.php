
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
    private $email;
    private $idDeHelado;
    private $cantidad;
    private static $fechaDeVenta;

   

    public function __construct($email,$idDeHelado,$cantidad) {
        $this->email = $email;
        $this->idDeHelado = $idDeHelado;
        $this->cantidad = $cantidad;
        self::$fechaDeVenta = date("Y-m-d");
        self::$id = rand(1,10000);
    }

    // b- El listado de ventas de un usuario ingresado.

    public static function FiltrarPorUsuario($listaDeVenta,$email)
    {
        $filtrarPorUsuario = null;

        if(isset($listaDeVenta) && isset($Usuario) && count($listaDeVenta) > 0)
        {
            $filtrarPorUsuario =  [];

            foreach($listaDeVenta as $unaVenta)
            {
                if($unaVenta->email == $email)
                {
                    array_push($filtrarPorUsuario,$email);
                }
            }
        }

        return  $filtrarPorUsuario;
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
                if($unaVenta::$fechaDeVenta < $fechaDesde && $unaVenta::$fechaDeVenta > $fechaHasta)
                {
                    array_push($filtrarPorVenta,$unaVenta);
                }
            }
        }

        return  $filtrarPorVenta;
    }

    // d- El listado de ventas por sabor ingresado.

    public static function FiltrarPorSabor($listaDeVenta,$listaDeHelados,$sabor,$fechaHasta)
    {
        $filtrarPorVenta = null;

        if(isset($listaDeVenta) && isset($Usuario) && count($listaDeVenta) > 0)
        {
            $filtrarPorVenta =  [];
            

            foreach($listaDeVenta as $unaVenta)
            {
                $unHelado = Helado::BuscarHeladoPorId($listaDeHelados,$unaVenta->idDeHelado);
                if(isset($unHelado))
                {
                    Helado::BuscarHeladoPorSabor(array($unHelado),$sabor);
                }
            }
        }

        return  $filtrarPorVenta;
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
            'email' => $this->email,
            'idDeHelado' => $this->idDeHelado,
            'cantidad' => $this->cantidad,
            'fechaDeVenta' => self::$fechaDeVenta,
            'id' => self::$id,
        );
    }

   

    

}

?>