

<?php

class Persona{
    public $legajo;
    public $nombre;
    public $telefono;
    public $email;

    public function __construct($legajo,$nombre,$email,$telefono = null) {
        
        $this->legajo = $legajo;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->telefono = $telefono;
    }

    public function __set($name, $value)
    {
        echo"la variable ".$name." no exixte , por lo tanto no se pudo guardar esto ".$value."<br>";
    }

    function __destruct() {
        print "Destruyendo " . __CLASS__ . "\n";
    }

    public function __get($name)
    {
        echo"la variable ".$name." no exixte<br>";
    }

    public function ToString() {

        return "<br> Nombre: $this->nombre
        <br> Email : $this->email
        <br> Telefono $this->telefono
        <br> Legajo : $this->legajo";

    }

}



?>