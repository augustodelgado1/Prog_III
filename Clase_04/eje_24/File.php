
<!-- 

Alumno : Augusto Delgado 
Div : A332
-->
<?php

class File
{
    private $path;
    private $nombreDelArchivo;

    public static function CrearUnDirectorio($ruta)
    {
        $estado = false;

        if(!file_exists($ruta)  )
        {
            $estado = mkdir($ruta);
        }

        return $estado;
    }
    public static function LeerArchivoCsv($nombreDeArchivo)
    {
        $listaDeLineas  = null;
        $unArchivo = fopen($nombreDeArchivo,"r");

        if(isset($unArchivo)){

            $listaDeLineas = [];
    
            while(($unaLinea = fgetcsv($unArchivo)) !== false){

                if(isset($unaLinea))
                {
                    array_push($listaDeLineas,$unaLinea);
                }
            }

            fclose($unArchivo);
        }

        return   $listaDeLineas ;
    }
}

?>