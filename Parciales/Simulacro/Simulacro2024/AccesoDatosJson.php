



<?php


class AccesoDatosJson
{
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

        if(isset($listaDePizzas) && isset($unArchivo))
        {
            $estado = fwrite($unArchivo, json_encode($listaDeArrayAsosiativos));
        }

        return  $estado ;
    }

    
}


?>