<!-- 

Alumno : Augusto Delgado 
Div : A332
-->

<!-- Aplicación No 24 ( Listado JSON y array de usuarios)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,Usuarios,vehículos,etc.),por ahora solo tenemos
usuarios).
En el caso de usuarios carga los datos del archivo usuarios.json.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista.
Hacer los métodos necesarios en la clase usuario-->


<?php


class Usuario{
    static private $id;
    static private $fechaDeRegistro;
    private $_mail;
    private $_clave;
    private $_nombre;
   

    public function __construct($nombre,$mail,$clave) {
        
        self::$id = Usuario::CrearIdAutoIncremental();
        $this->_mail = $mail;
        $this->_nombre = $nombre;
        $this->_clave = $clave;
        self::$fechaDeRegistro = date("Y-m-d H:i:s");
    }

    private static function CrearIdAutoIncremental()
    {
        return  rand(1,10.000);
    }
    // private static function CrearIdAutoIncremental()
    // {
    //     return  1;
    // }
    public static function BuscarUnUsuarioPorId($listaDeUsuario,$idStr)
    {
        $unUsuarioABuscar = null;

        if(isset($listaDeUsuario) && count($listaDeUsuario) > 0)
        {
            foreach($listaDeUsuario as $unUsuario)
            {
                if($unUsuario::$id == $idStr ) 
                {
                    $unUsuarioABuscar = $unUsuario;
                    break;
                }
            }
        }

        return $unUsuarioABuscar;
    }


    private function ObternerDatos() {
        return array(
            'id' => self::$id,
            '_nombre' => $this->_nombre,
            '_clave' => $this->_clave,
            '_mail' => $this->_mail,
            'fechaDeRegistro' => self::$fechaDeRegistro
        );
    }
    public function EscribirUnUsuarioPorJson($nombreDeArchivo)
    {
        $estado = false;
        $unArchivo = fopen($nombreDeArchivo,"a+");

        if(isset($unArchivo) )
        {
            $estado = fwrite($unArchivo ,json_encode($this->ObternerDatos()));
            fclose($unArchivo);
        }

        return $estado;
    }
}



?>