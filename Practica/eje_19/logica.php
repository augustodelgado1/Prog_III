

<?php
Require_once "Rectangulo.php";
Require_once "Triangulo.php";

$unRectangulo = new Rectangulo(1,2);
$unTriangulo= new Triangulo(1,966);
echo "Rectangulo =  {$unRectangulo->ToString()}
<br> Triangulo =  {$unTriangulo->ToString()}";
?>