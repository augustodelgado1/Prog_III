

<?php


class Clase
{
    private static $id;
    private $nombre;
    private $apellido; 
    private $clave;
    private $mail;
    private $localidad;
    private static $fechaDeRegistro;

    public function __construct($mail,$clave,$nombre,$apellido,$localidad) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->mail = $mail;
        $this->clave = $clave;
        $this->localidad = $localidad;
        self::$fechaDeRegistro = date("Y-m-d");
        self::$id = Clase::ObtenerIdAutoIncremental();
    }

    private static function ObtenerIdAutoIncremental()
    {
        return rand(1,10000);
    }
}


?>