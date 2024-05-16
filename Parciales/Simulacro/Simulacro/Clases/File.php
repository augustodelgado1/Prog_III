



<?php

class File
{
    public static function MoverFoto($tmpNombre,$rutaASubir,$nombreDeArchivo)
    {
        $estado = false;
       
        if(isset($tmpNombre) && isset($rutaASubir))
        {
            $rutaDestino = $rutaASubir . $nombreDeArchivo;
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

    public static function LeerListaJson($nombreDeArchivo,$esArrayAssosiativo)
    {
        $unArchivo = fopen($nombreDeArchivo,"r");
        $listaDeArrayAsosiativos = null;
        
        if(isset($unArchivo) &&  $unArchivo !== false)
        {
            $strJson = fgets($unArchivo);
            $listaDeArrayAsosiativos =  json_decode($strJson,$esArrayAssosiativo);
        }

        return  $listaDeArrayAsosiativos;
    }
    public static function EscribirEnArrayJson($listaDeArrayAsosiativos,$nombreDeArchivo)
    {
        $estado = false; 
        $unArchivo = fopen($nombreDeArchivo,"w");

        if( isset($unArchivo))
        {
            $estado = fwrite($unArchivo, json_encode($listaDeArrayAsosiativos));
        }

        return  $estado ;
    }
}


?>



