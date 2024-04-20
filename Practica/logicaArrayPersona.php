
<?php
Require_once "Persona.php";

$listaDePersonas[] = new Persona(1,"Pedro","Pedro@gmail.com");
$listaDePersonas[] = new Persona(2,"Mario","Mario@gmail.com");
$listaDePersonas[] = new Persona(3,"Juan","Juan@gmail.com");
$listaDePersonas[] = new Persona(4,"Marcelo","Marcelo@gmail.com");
$listaDePersonas[] = new Persona(5,"Roberto","Roberto@gmail.com");

$Index = array_search(new Persona(1,"Pedro","Pedro@gmail.com"),$listaDePersonas);


if($Index != false && $Index >= 0)
{
    echo"Index :{$Index} la persona es <br>".$listaDePersonas[$Index]->ToString(); 
}else{
    echo "No se encontro el elemento";
}
echo "<br>";

// var_dump($listaDePersonas);

// echo "<br><br><br>Elimino un elemento con uset<br>";

// unset($listaDePersonas[0]);

// echo "<br><br><br><br><br>";
// var_dump($listaDePersonas);


// var_dump($listaDePersonas);

// echo "<br><br><br>Elimino el primer elemento con array_shift <br>";

// array_shift($listaDePersonas);

// echo "<br><br><br><br><br>";
// var_dump($listaDePersonas);



var_dump($listaDePersonas);

echo "<br><br><br>Elimino el [2] elemento con array_splice<br>";

array_splice($listaDePersonas,2,1);

echo "<br><br><br><br><br>";
var_dump($listaDePersonas);


var_dump($listaDePersonas);

echo "<br><br><br>Elimino el [2] elemento con array_splice<br>";

array_fill_keys($listaDePersonas,2,1);

echo "<br><br><br><br><br>";
var_dump($listaDePersonas);





?>