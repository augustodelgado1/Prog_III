<!--
 Aplicación No 27 (Registro BD)
Archivo: registro.php
método:POST
Recibe los datos del 
usuario( nombre,apellido, clave,mail,localidad )
por POST , crear
un objeto con la fecha de registro y 
utilizar sus métodos para poder hacer el alta,
guardando los datos la base de datos
retorna si se pudo agregar o no. 
-->

<?php

require_once "AccesoADatos.php";

class Usuario
{
    private $nombre;
    private $apellido; 
    private $clave;
    private $mail;
    private $localidad;
    private static $fechaDeRegistro;

    public function __construct($mail,$clave,$nombre = "",$apellido = "",$localidad = "") {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->mail = $mail;
        $this->clave = $clave;
        $this->localidad = $localidad;
        self::$fechaDeRegistro = date("Y-m-d");
    }

//     <!--
//  Aplicación No 27 (Registro BD)
// Archivo: registro.php
// método:POST
// Recibe los datos del 
// usuario( nombre,apellido, clave,mail,localidad )
// por POST , crear
// un objeto con la fecha de registro y 
// utilizar sus métodos para poder hacer el alta,
// guardando los datos la base de datos
// retorna si se pudo agregar o no. 
// -->
    
    public function AgregarUnUsuarioBD()
    {
        $estado = false;
        $unObjetoAccesoDato = AccesoDatos::ObtenerUnObjetoPdo();
        $consulta = null;
        if(isset($unObjetoAccesoDato))
        {
            $consulta = $unObjetoAccesoDato ->RealizarConsulta(
                "INSERT INTO usuario (nombre,apellido,clave,mail,localidad,fechaDeRegistro) 
            VALUES (:nombre,:apellido,:clave,:mail,:localidad,:fechaDeRegistro) ");
            $consulta->bindValue(':nombre',$this->nombre,PDO::PARAM_STR);
            $consulta->bindValue(':apellido',$this->apellido,PDO::PARAM_STR);
            $consulta->bindValue(':mail',$this->mail,PDO::PARAM_STR);
            $consulta->bindValue(':clave',$this->clave,PDO::PARAM_STR);
            $consulta->bindValue(':localidad',$this->localidad,PDO::PARAM_STR);
            $consulta->bindValue(':fechaDeRegistro',self::$fechaDeRegistro);
            $estado = $consulta->execute();
        }

        return  $estado;
    }

    public static function ObtenerListaDeUsuariosBD()
    {
        $listaDeUsuarios = null;
        $unObjetoAccesoDato = AccesoDatos::ObtenerUnObjetoPdo();
        $consulta = null;
        if(isset($unObjetoAccesoDato))
        {
            $consulta = $unObjetoAccesoDato->RealizarConsulta("SELECT * FROM usuario");
            $estado = $consulta->execute();
            $listaDeUsuarios = $consulta->fetchAll();
        }

        return  $listaDeUsuarios;
    }


    public function VerificarUnUsuarioPorMailBD()
    {
        $estado = false;
        $unObjetoAccesoDato = AccesoDatos::ObtenerUnObjetoPdo();
        $consulta = null;
        if(isset($unObjetoAccesoDato))
        {
            $consulta = $unObjetoAccesoDato->RealizarConsulta("SELECT COUNT(*) as cantidadTotal FROM usuario as u where u.mail = :mail");
            $consulta->bindValue(':mail',$this->mail,PDO::PARAM_STR);
            $consulta->execute();
            $arrayPdo = $consulta->fetch(PDO::FETCH_ASSOC);
            $estado = $arrayPdo['cantidadTotal'] > 0;
        }

        return  $estado;
    }

    public function VerificarUnUsuarioBD()
    {
        $estado = false;
        $unObjetoAccesoDato = AccesoDatos::ObtenerUnObjetoPdo();
        $consulta = null;
        if(isset($unObjetoAccesoDato))
        {
            $consulta = $unObjetoAccesoDato->RealizarConsulta("SELECT COUNT(*) as cantidadTotal FROM usuario as u where u.clave = :clave and u.mail = :mail");
            $consulta->bindValue(':clave',$this->clave,PDO::PARAM_STR);
            $consulta->bindValue(':mail',$this->mail,PDO::PARAM_STR);
            $consulta->execute();
            $arrayPdo = $consulta->fetch(PDO::FETCH_ASSOC);
            $estado = $arrayPdo['cantidadTotal'] > 0;
        }

        return  $estado;
    }

    public static function ObtenerUnUsuarioPorArrayAsosiativo($unArrayAsosiativo)
    {
        $unUsuario = null;

        if(isset($unArrayAsosiativo) && count($unArrayAsosiativo) > 0)
        {
            $unUsuario = new Usuario($unArrayAsosiativo['nombre'],$unArrayAsosiativo['apellido'],
            $unArrayAsosiativo['mail'],$unArrayAsosiativo['clave'],$unArrayAsosiativo['localidad']);
            $unUsuario::$fechaDeRegistro = $unArrayAsosiativo['fechaDeRegistro'];
        }
        
        return $unUsuario;
    }

    public static function ObtenerUnUsuarioPorArrayAsosiativoPorMailYClave($unArrayAsosiativo)
    {
        $unUsuario = null;

        if(isset($unArrayAsosiativo) && count($unArrayAsosiativo) > 0)
        {
            $unUsuario = new Usuario( $unArrayAsosiativo['mail'],$unArrayAsosiativo['clave']);
        }
        
        return $unUsuario;
    }


}

?>