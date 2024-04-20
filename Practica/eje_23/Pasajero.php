<!-- Pasajero
Atributos privados: _apellido (string), _nombre (string), _dni (string), _esPlus (boolean)
Crear un constructor capaz de recibir los cuatro parámetros.
Crear el método de instancia “Equals” que permita comparar dos objetos Pasajero. Retornará
TRUE cuando los _dni sean iguales.
Agregar un método getter llamado GetInfoPasajero, que retornará una cadena de caracteres con los
atributos concatenados del objeto.
Agregar un método de clase llamado MostrarPasajero que mostrará los atributos en la página. -->

<?php

class Pasajero
{
    private $_nombre;
    private $_apellido;
    private $_dni;
    private $_esPlus;

    // Atributos privados: _apellido (string), _nombre (string), _dni (string), _esPlus (boolean)

    // Crear un constructor capaz de recibir los cuatro parámetros.
    public function __construct($_nombre,$_apellido,$_dni,$_esPlus = false) {

        $this->_apellido = $_apellido;
        $this->_nombre = $_nombre;
        $this->_dni = $_apellido;
        $this->_esPlus = $_esPlus;
    }

// //     Crear el método de instancia “Equals” 
// que permita comparar dos objetos Pasajero. Retornará
// // TRUE cuando los _dni sean iguales.

    public function Equals($otroPasajero) {
        $comparacion = false;

        if($otroPasajero != null) {
            $comparacion = $this->_dni == $otroPasajero->_dni;
        }

        return $comparacion;
    }


//     Agregar un método getter llamado 
//     GetInfoPasajero, que retornará una cadena de caracteres con los
// atributos concatenados del objeto.
    public function GetInfoPasajero() {

        return "<br> Nombre: $this->_nombre
        <br> Apellido : $this->_apellido
        <br> Dni: $this->_dni
        <br> EsPlus : $this->_esPlus";

    }

    // Agregar un método de clase llamado MostrarPasajero que mostrará los atributos en la página. -->

    public static function MostrarPasajero($unPasajero) {

        if($unPasajero != null)
        {
            echo $unPasajero->GetInfoPasajero();
        }else{
            echo "No se pudo encontrar info del pasajero";
        }

    }
}


?>