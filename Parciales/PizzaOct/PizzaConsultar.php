
<!-- 2-
(1pt.) PizzaConsultar.php: (por POST)Se ingresa Sabor,Tipo, 
si coincide con algún registro del archivo Pizza.json,
retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor. --> 

<?php

require_once 'Pizza.php';
$mensaje = "No se recibieron parametros";
$listaDePizza = Pizza::LeerListaJson("Pizza.json");

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tipo']) && isset($_POST['sabor']) )
{
    $mensaje = "no Hay";
    
    if(($unaPizza = Pizza::BuscarPizzaPorSaborYTipo($listaDePizza,$_POST['tipo'],$_POST['sabor'])) !== null)
    {
        $mensaje = "Si Hay";
    }else{

        if(Pizza::BuscarPizzaPorSabor($listaDePizza,$_POST['sabor']))
        {
            $mensaje = "No Existe el tipo";
        }else{

            if(Pizza::FiltrarPorTipo($listaDePizza,$_POST['tipo']) !== null)
            {
                $mensaje = "No Existe el sabor";
            }
        }
    }
}

echo $mensaje ;


?>