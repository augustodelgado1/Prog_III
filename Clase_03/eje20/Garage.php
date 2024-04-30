<!-- 

Alumno : Augusto Delgado 
Div : A332
-->


<?php

Require_once "Auto.php";

class Garage 
{
    private $_razonSocial;
    private $_precioPorHora;
    private $_autos = [];

//     Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:

// i. La razón social.
// ii. La razón social, y el precio por hora.
    public function __construct($razonSocial , $precioPorHora = 0)
    {
        $this->_razonSocial = $razonSocial;
        $this->_precioPorHora = $precioPorHora;
        $this->_autos = array();
    }

//     Crear un método de clase para poder hacer el alta de un Garage y, guardando los datos en un archivo
// // garages.csv.

        // public static function AgregarUnGaragePorCsv($unGarage,$nombreDeArchivo)
        // {
        //     $estado = false;
        //     $unArchivo = fopen($nombreDeArchivo,"a+");

        //     if(isset($unArchivo) && isset($unGarage)){

        //         $estado = fputcsv($unArchivo,array($unGarage->_razonSocial,$unGarage->_precioPorHora,implode(",",$unGarage->_Garages)));
        //         fclose($unArchivo);
        //     }

        //     return $estado;
        // }

        

        // Hacer los métodos necesarios en la clase Garage para poder leer el listado desde el archivo
        // garage.csv

        

        public static function LeerArchivoCsv($nombreDeArchivo)
        {
            $listaDeDeGarage = null;
            $listaDeLineas  = File::LeerArchivoCsv($nombreDeArchivo);
            $unGarage = null;
            if(isset( $listaDeLineas))
            {
                $listaDeDeGarage = [];

                foreach($listaDeLineas as $unaLinea)
                {
                    $len = count($unaLinea);

                    if(isset($unaLinea) && $len <= 2 
                    && ($unGarage = Garage::AltaDeGarage($unaLinea[0], $unaLinea[1])) !== null)
                    {
                        array_push( $listaDeDeGarage,$unGarage );
                    }

                    if($len == 4 && isset($unGarage) 
                    && ($unAuto = Auto::AltaDeAuto($unaLinea[0], $unaLinea[1],$unaLinea[2],$unaLinea[3])) !== null)
                    {
                        $unGarage->Add($unAuto);
                    }
                }
            }

            return $listaDeDeGarage ;
        }

        public static function EscribirArrayDeGarage($listaDeGarages,$nombreDeArchivo)
        {
            $estado = false;
            $unArchivo = fopen($nombreDeArchivo,"w");
    
            if(isset($unArchivo) && isset($listaDeGarages)){
                
                $estado = true;
                
                foreach($listaDeGarages as $unGarage)
                {
                    if(fputcsv($unArchivo,array($unGarage->_razonSocial,$unGarage->_precioPorHora)) == false ||
                    Auto::EscribirListaDeAutos($unGarage->_autos,$unArchivo)  == false)
                    {
                        $estado = false;
                        break;
                    }
                }
                fclose($unArchivo);
            }
    
            return $estado;
        }

        public static function AltaDeGarage($razonSocial , $precioPorHora = 0,$listaDeGarages = [])
        {
            $unGarage = null;

                if(isset($razonSocial) && isset($precioPorHora) && isset($listaDeGarages))
                {
                    $unGarage =  new Garage($razonSocial,$precioPorHora);
                    $unGarage->_autos = $listaDeGarages;
                }

            return $unGarage;
        }

// 

// Se deben cargar los datos en un array de garage.
// En testGarage.php, crear Garages y un garage. Probar el buen funcionamiento de todos los
// métodos.















//     Realizar un método de instancia llamado 
//     “MostrarGarage”, que no recibirá parámetros y que
// mostrará todos los atributos del objeto.

    public function MostrarGarage()
    {
        $contador = 1;
        $data = "Razon social : $this->_razonSocial
        <br> Precio Por Hora : $this->_precioPorHora";

        if($this->_autos != null)
        {
            $data .= "<br>Los Garages del garage son<br><br>";

            foreach($this->_autos as $unAuto )
            {
                $data .= "Auto [$contador]<br>".Auto::MostrarAuto($unAuto)."<br>";
                $contador++;
            }

            // var_dump($this->_Garages);
        }

        return $data;
    }

    public function getCantidadDeGaragesGuardados()
    {
        return count($this->_autos);
    }

//     Crear el método de instancia “Equals” 
//     que permita comparar al objeto de tipo Garaje con un
// objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.

    public function Equals($unAuto)
    {
       $retorno = false;

    //    echo "<br><br><br>Esto en equuals<br><br>";

       if($unAuto != null)
       {
         $retorno = in_array( $unAuto , $this->_autos );
       }

    //    var_dump( $retorno );
       return $retorno;
    }

//     Crear el método de instancia “Add” para que permita 
//     sumar un objeto “Auto” al “Garage” (sólo si
// el auto no está en el garaje, de lo contrario informarlo).


    public function Add($unAuto)
    {
       $retorno = false;

       if($retorno = ($unAuto != null && $this->Equals($unAuto) == false))
       {
         $this->_autos[] = $unAuto;
        //  echo "<br><br><br> Se aniadio un elemento <br><br><br>";
       }
       
       return $retorno;
    }
    

//     Crear el método de instancia “Remove” para que 
//     permita quitar un objeto “Auto” del “Garage”
// (sólo si el auto está en el garaje, de lo contrario informarlo)

    public function Remove($unAuto)
    {
       $retorno = false;
       $index = 0;

       if($retorno = ($unAuto != null && $this->Equals($unAuto) == true))
       {
           $index = array_search($unAuto, $this->_autos);
           array_splice($this->_autos,$index,1);
       }

       
       return $retorno;
    }




}

?>