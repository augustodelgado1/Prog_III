

<?php

class Usuario
{
    private static $id;
    private $email;
    private $clave;
    private static $fechaDeRegistro;

    public function __construct($email,$clave,$cantidad) {
        $this->email = $email;
        $this->clave = $clave;
        self::$fechaDeRegistro = date("Y-m-d");
        self::$id = rand(1,10000);
    }
    
}


?>