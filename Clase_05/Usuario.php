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

    public function __construct($nombre,$apellido,$mail,$clave,$localidad) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->mail = $mail;
        $this->clave = $clave;
        $this->localidad = $localidad;
        self::$fechaDeRegistro = date("Y-m-d");
    }

    public function ToString()
    {
        return "Nombre :".$this->nombre.PHP_EOL."Apellido:".$this->apellido.PHP_EOL
        ."Mail:".$this->mail.PHP_EOL."Localidad:".$this->localidad.PHP_EOL."FechaDeRegistro:".self::$fechaDeRegistro;
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
    public static function EscribirArrayPorJson($listaDeUsuario,$nombreDeArchivo)
    {
        $estado = false;
        $unArchivo = fopen($nombreDeArchivo,"w");

        if(isset($unArchivo) && isset($listaDeUsuario) && count($listaDeUsuario) > 0)
        {
            Usuario::SerializarArrayDeUsuarioJson($listaDeUsuario);
            var_dump($listaDeUsuario);
            $estado = fwrite($unArchivo ,json_encode($listaDeUsuario));
            fclose($unArchivo);
        }

        return $estado;
    }

    private static function SerializarArrayDeUsuarioJson($listaDeArrayAsosiativos)
    {
        $listaDeUsuario = null;

        if( isset($listaDeArrayAsosiativos))
        {
            $listaDeUsuario = [];

            foreach ($listaDeArrayAsosiativos as $ArrayAsosiativo)
            {
                foreach($ArrayAsosiativo as $key => $value)
                {
                    if(!property_exists(__CLASS__,$key))
                    {
                        $index = array_search($key, $ArrayAsosiativo);
                        array_splice($ArrayAsosiativo,$index,1);
                    }
                }
            }
        }

        return $listaDeUsuario;
    }

    // public function Remove($unAuto)
    // {
    //    $retorno = false;
    //    $index = 0;

    //    if($retorno = ($unAuto != null && $this->Equals($unAuto) == true))
    //    {
    //        $index = array_search($unAuto, $this->_autos);
    //        array_splice($this->_autos,$index,1);
    //    }

       
    //    return $retorno;
    // }

    private function ObternerDatos() {
        return array(
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'mail' => $this->mail,
            'clave' => $this->clave,
            'localidad' => $this->localidad,
            'fechaDeRegistro' => self::$fechaDeRegistro
        );
    }

    // $nombre,$apellido,$mail,$clave,$localidad
    public static function ObtenerUnUsuarioPorArrayAsosiativo($unArrayAsosiativo)
    {
        $unUsuario = null;

        if(Usuario::ValidarKeys($unArrayAsosiativo) == true)
        {
            $unUsuario = new Usuario($unArrayAsosiativo['nombre'],$unArrayAsosiativo['apellido'],
            $unArrayAsosiativo['mail'],$unArrayAsosiativo['clave'],$unArrayAsosiativo['localidad']);
        }
        
        return $unUsuario;
    }

    private static function ValidarKeys($unArrayAsosiativo)
    {
        $estado = false;

        if(isset($unArrayAsosiativo) && count($unArrayAsosiativo) > 0)
        {
            $estado = true;
            foreach($unArrayAsosiativo as $key => $value)
            {
                if(!property_exists(__CLASS__, $key))
                {
                    $estado = false;
                    echo'Es esta '. $key ;
                    break;
                }
            }
        }

        return $estado;
    }


    
    // private static function SerializarArrayDeUsuarioJson($listaDeUsuario)
    // {
    //     $listaStr = null;

    //     if( isset($listaDeUsuario))
    //     {
    //         $listaStr = [];

    //         foreach ($listaDeUsuario as $unUsuario)
    //         {
    //             array_push($listaStr, $unUsuario->ObternerDatos() );
    //         }
    //     }

    //     return $listaStr;
    // }

}

?>