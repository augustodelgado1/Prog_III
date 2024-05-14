<!-- B- (1 pt.) HeladeriaAlta.php: (por POST) 
se ingresa Sabor, Precio, Tipo (“Agua” o “Crema”), 
Vaso (“Cucurucho”,
“Plástico”), Stock (unidades). 

Se guardan los datos en en el archivo de texto heladeria.json, tomando un id autoincremental como
identificador(emulado) .Sí el nombre y tipo ya existen , se actualiza el precio y se suma al stock existente.
completar el alta con imagen del helado, guardando la imagen con el sabor y tipo como identificación en la
carpeta /ImagenesDeHelados/2024.
-->



<?php

class Helado
{
    private static $id;
    private $precio;
    private $stock;
    private $tipo;
    private $sabor;
    private $vaso;

    public function __construct($precio,$stock,$tipo,$sabor,$vaso) {
        $this->precio = $precio;
        $this->stock = $stock;
        $this->tipo = $tipo;
        $this->sabor = $sabor;
        $this->vaso = $vaso;
        self::$id = Helado::ObtenerIdAutoIncremental();
    }

    public function ActualizarHelado($precio,$stock)
    {
        if(isset($precio) && isset($stock) 
        && $stock > 0 && $precio > 0)
        {
            $this->precio = $precio;
            $this->stock += $stock;
        }
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

    public function MoverFoto($tmpNombre,$rutaASubir,$nombreDeArchivo)
    {
        $estado = false;
       
        if(isset($tmpNombre) && isset($rutaASubir))
        {
            $rutaDestino = $rutaASubir.$this->sabor.$this->tipo.$nombreDeArchivo;
            $estado =  move_uploaded_file($tmpNombre,$rutaDestino);
        }

        return $estado;
    }


    private static function ObtenerIdAutoIncremental()
    {
        return rand(1,10000);
    }

    public static function ObtenerUnHeladoPorArrayAsosiativo($unArrayAsosiativo)
    {
        $unHelado = null;

        if(isset($unArrayAsosiativo))
        {
            $unHelado = new Helado($unArrayAsosiativo['precio'],
            $unArrayAsosiativo['stock'],$unArrayAsosiativo['tipo'],
            $unArrayAsosiativo['sabor'],$unArrayAsosiativo['vaso']);
            var_dump($unHelado);
        }
        
        return $unHelado;
    }


     //Escibir
     public static function EscribirHeladoEnArrayJson($listaDeHelados,$nombreDeArchivo)
    {
        $estado = false; 
        $unArchivo = fopen($nombreDeArchivo,"w");
        $listaDeArrayAsosiativos = null;

        if(isset($listaDeHelados) && isset($unArchivo)
        && ($listaDeArrayAsosiativos = Helado::SerializarListaJson($listaDeHelados)) !== null)
        {
            $estado = fwrite($unArchivo, json_encode( $listaDeArrayAsosiativos));
        }

        return  $estado ;
    }

    //Serializar
    private static function SerializarListaJson($listaDeHelados)
    {
        $listaDeArrayAsosiativos = null; 

        if(isset($listaDeHelados))
        {
            $listaDeArrayAsosiativos = [];

            foreach($listaDeHelados as $unHelado)
            {
                array_push($listaDeArrayAsosiativos,$unHelado->ObtenerDatos());
            }
        }

        return  $listaDeArrayAsosiativos ;
    }

    
    public static function BuscarHeladoPorSabor($listaDeHelados,$sabor)
    {
        $unaHeladoABuscar = null; 

        if(isset($listaDeHelados) )
        {
            foreach($listaDeHelados as $unaHelado)
            {
                if($unaHelado->sabor == $sabor)
                {
                    $unaHeladoABuscar = $unaHelado; 
                    break;
                }
            }
        }

        return  $unaHeladoABuscar;
    }

    


    public static function BuscarHeladoPorTipo($listaDeHelados,$tipo)
    {
        $unaHeladoABuscar = null; 

        if(isset($listaDeHelados) )
        {
            foreach($listaDeHelados as $unaHelado)
            {
                if($unaHelado->tipo == $tipo)
                {
                    $unaHeladoABuscar = $unaHelado; 
                    break;
                }
            }
        }

        return  $unaHeladoABuscar;
    }

    public function RealizarVenta($email,$cantidad)
    {
        $unaVenta = null;
        if(isset($email) && $this->stock > 0 && $cantidad > 0 && $cantidad <= $this->stock)
        {
            
            $unaVenta = new Venta($email,self::$id,$cantidad);
            $this->stock -= $cantidad;
        }

        return $unaVenta;
    }

    public function GetVaso()
    {
        return $this->vaso;
    }

    

    
    public static function BuscarHeladoPorTipoYSabor($listaDeHelados,$tipo,$sabor)
    {
        $unaHeladoABuscar = null; 

        if(isset($listaDeHelados))
        {
            foreach($listaDeHelados as $unaHelado)
            {
                if($unaHelado->sabor == $sabor && $unaHelado->tipo == $tipo)
                {
                    $unaHeladoABuscar = $unaHelado; 
                    break;
                }
            }
        }

        return  $unaHeladoABuscar;
    }

   
    public static function LeerListaJson($nombreDeArchivo)
    {
        $unArchivo = fopen($nombreDeArchivo,"r");
        $listaDeArrayAsosiativos = null;
        $listaDeHelado = null;
        if(isset($unArchivo) &&  $unArchivo !== false)
        {
            $strJson = fgets($unArchivo);
            $listaDeArrayAsosiativos =  json_decode($strJson,true);
            $listaDeHelado = Helado::DeserializarListaJson($listaDeArrayAsosiativos);
        }

        return  $listaDeHelado;
    }

    

    ///Deserializar Lista Json

    private static function DeserializarListaJson($listaDeArrayAsosiativos)
    {
        $listaDeHelado = null; 

        if(isset($listaDeArrayAsosiativos))
        {
            $listaDeHelado = [];

            foreach($listaDeArrayAsosiativos as $unArrayAsosiativo)
            {
                array_push($listaDeHelado,Helado::ObtenerUnHeladoPorArrayAsosiativo($unArrayAsosiativo));
            }
        }

        return  $listaDeHelado ;
    }


    ///ObtenerDatos
    private function ObtenerDatos()
    {
        return array(
            'stock' => $this->stock,
            'precio' => $this->precio,
            'tipo' => $this->tipo,
            'sabor' => $this->sabor,
            'vaso' => $this->vaso,
            'id' => self::$id,
        );
    }

}

?>