

<?php


class Usuario
{
    private static $id;
    private $nombre;
    private $clave;
    private $mail;
    private static $fechaDeRegistro;

    public function __construct($mail,$clave,$nombre) {
        $this->nombre = $nombre;
        $this->mail = $mail;
        $this->clave = $clave;
        self::$fechaDeRegistro = date("Y-m-d");
        self::$id = Usuario::ObtenerIdAutoIncremental();
    }

    private static function ObtenerIdAutoIncremental()
    {
        return rand(1,10000);
    }
}


?>