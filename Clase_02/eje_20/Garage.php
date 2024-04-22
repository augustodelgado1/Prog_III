<!-- Crear la clase Garage que posea como atributos privados:

_razonSocial (String)
_precioPorHora (Double)
_autos (Autos[], reutilizar la clase Auto del ejercicio anterior)

Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:

i. La razón social.
ii. La razón social, y el precio por hora.

Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y que
mostrará todos los atributos del objeto.
Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage” (sólo si
el auto no está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Add($autoUno);
Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del “Garage”
(sólo si el auto está en el garaje, de lo contrario informarlo).
Ejemplo: $miGarage->Remove($autoUno);
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los métodos. -->

<?php
Require_once "Auto.php";

class Garage 
{
    private $_razonSocial;
    private $_precioPorHora;
    private $_autos;

//     Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:

// i. La razón social.
// ii. La razón social, y el precio por hora.
    public function __construct($razonSocial , $precioPorHora = 0)
    {
        $this->_razonSocial = $razonSocial;
        $this->_precioPorHora = $precioPorHora;
        $this->_autos = array();
    }

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
            $data .= "<br>Los Autos del garage son<br><br>";

            foreach($this->_autos as $unAuto )
            {
                $data .= "Auto [$contador]<br>".Auto::MostrarAuto($unAuto)."<br>";
                $contador++;
            }
        }

        return $data;
    }

    public function getCantidadDeAutosGuardados()
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