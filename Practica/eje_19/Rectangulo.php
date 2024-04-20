

<?php

Require_once "FiguraGeometrica.php";

class Rectangulo extends FiguraGeometrica
{

    private  $_ladoDos; 
    private  $_ladoUno; 
    public function __construct($_ladoDos, $_ladoUno)
    {
        $this->_ladoDos = $_ladoDos;
        $this->_ladoUno = $_ladoUno;
        parent::__construct();
    }
    public function Dibujar()
    {
        return " ";
    }

   protected function CalcularDatos()
   {
     $this->_superficie = $this->_ladoUno * $this->_ladoDos;
     $this->_perimetro = $this->_ladoDos + $this->_ladoUno;
   }

   public function ToString()
   {
     return parent::ToString()."<br>LadoDos : ".
     $this->_ladoDos."<br>LadoUno : ".
     $this->_ladoUno;
   }
}

?>