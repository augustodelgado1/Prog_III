<!-- 
Aplicación No 19 (Figuras geométricas)
La clase FiguraGeometrica posee: todos sus atributos protegidos, 
un constructor por defecto, un
método getter y setter para el atributo _color, un método virtual (ToString) y dos métodos
abstractos: Dibujar (público) y CalcularDatos (protegido).
CalcularDatos será invocado en el constructor de la clase derivada que corresponda, su
funcionalidad será la de inicializar los atributos _superficie y _perimetro.
Dibujar, retornará un string (con el color que corresponda) formando la figura geométrica del objeto
que lo invoque (retornar una serie de asteriscos que modele el objeto).
Ejemplo:



Utilizar el método ToString para obtener toda la información completa del objeto, y luego dibujarlo
por pantalla.
Jerarquía de clases:

Augusto Delgado
 -->

 <?php
abstract Class FiguraGeometrica 
{
    protected $_color;
    protected $_perimetro;
    protected $_superficie;

    public function __construct()
    {
        $this->CalcularDatos();
    }

    public function getColor()
    {
        return $this->_color;
    }

//     CalcularDatos será invocado en el constructor de la clase derivada que corresponda, su
// funcionalidad será la de inicializar los atributos _superficie y _perimetro.

    protected abstract function CalcularDatos();

// //     Dibujar, retornará un string (con el color que corresponda) 
// formando la figura geométrica del objeto
// // que lo invoque (retornar una serie de asteriscos que modele el objeto)
    public abstract function Dibujar();
 
    public function SetColor($setColor){
        $this->_color = $setColor;
    }

    public function  ToString()
    {
        return "Color: $this->_color 
        <br> Perimetro: $this->_perimetro
        <br> Superficie: $this->_superficie";
    }
}
 ?>