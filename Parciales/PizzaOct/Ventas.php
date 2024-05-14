

<?php

require_once "AccesoADatos.php";
class Ventas
{
    private static $id;
    private $email;
    private $idDePizza;
    private $cantidad;
    private static $fechaDeVenta;

    public function __construct($email,$idDePizza,$cantidad) {
        $this->email = $email;
        $this->idDePizza = $idDePizza;
        $this->cantidad = $cantidad;
        self::$fechaDeVenta = date("Y-m-d");
        self::$id = rand(1,10000);
    }

    public function AgregarUnaVentaBD()
    {
        $estado = false;
        $unObjetoAccesoDato = AccesoDatos::ObtenerUnObjetoPdo();
        $consulta = null;
        if(isset($unObjetoAccesoDato))
        {
            $consulta = $unObjetoAccesoDato ->RealizarConsulta(
                "INSERT INTO venta (email,idDePizza,cantidad,fechaDeVenta) 
            VALUES (:email,:idDePizza,:cantidad,:fechaDeVenta) ");
            $consulta->bindValue(':email',$this->email,PDO::PARAM_STR);
            $consulta->bindValue(':idDePizza',$this->idDePizza,PDO::PARAM_INT);
            $consulta->bindValue(':cantidad',$this->cantidad,PDO::PARAM_INT);
            $consulta->bindValue(':fechaDeVenta',self::$fechaDeVenta);
            $estado = $consulta->execute();
        }

        return  $estado;
    }

    public function MoverFoto($tmpNombre,$rutaASubir,$nombreDeArchivo)
    {
        $estado = false;
       
        if(isset($tmpNombre) && isset($rutaASubir))
        {
            var_dump($nombreDeArchivo);
            $rutaDestino = $rutaASubir .self::$fechaDeVenta. $nombreDeArchivo;
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

    

}

?>