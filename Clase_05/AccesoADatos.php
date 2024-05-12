<?php


class AccesoDatos
{
    private static $conneccionStr;
    private $objetoPdo;
    private static $objetoAccesoDatos;

    private function __construct() 
    {
        try {
            self::$conneccionStr = 'mysql:host=localhost;dbname=eje7';
            $this->objetoPdo = new PDO(self::$conneccionStr,'root','');
          var_dump( $this->objetoPdo);
          //exec -> ejecuta una quary 
        } catch (PDOException $th) {
            echo "Error: ".$th->getMessage();
            die();//termina la ejecucion el programa
        }
    }

    /*
    Singleton:es un objeto que solo se instancia una vez
    */

    public static function ObtenerUnObjetoPdo()
    {
        if(!isset(self::$objetoAccesoDatos))
        {
            self::$objetoAccesoDatos = new AccesoDatos();
        }

        return self::$objetoAccesoDatos;
    }

    public static function RealizarConsulta($strConsulta)
    {
        $consulta = null;
        if(isset(self::$objetoAccesoDatos))
        {
            $consulta = self::$objetoAccesoDatos->objetoPdo->prepare($strConsulta);
            var_dump($consulta);
        }
        

        return $consulta;
        
    }

}

?>