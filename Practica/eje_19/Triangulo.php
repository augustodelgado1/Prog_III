



<?php

Require_once "FiguraGeometrica.php";

class Triangulo extends FiguraGeometrica
{

    private  $_altura; 
    private  $_base; 
    public function __construct($_altura, $_base)
    {
        $this->_altura = $_altura;
        $this->_base = $_base;
        parent::__construct();
    }
    public function Dibujar()
    {
        
        return " ";
    }

   protected function CalcularDatos()
   {
     $this->_superficie = $this->_altura * $this->_base;
     $this->_perimetro = $this->_base + $this->_altura;
   }

   public function ToString()
   {
     return parent::ToString()."<br>_base : ".
     $this->_base."<br>_altura : ".
     $this->_altura;
   }
}

?>