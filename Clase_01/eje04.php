<!-- /*
Aplicación No 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla.

Augusto Delgado 
A332
*/ -->

<?php

$op1 = rand(0,9);
$op2 = rand(0,9); 
$operadores = array('+', '-', '/' , '*');
$operador = rand(0,(count($operadores)-1));
$resultado;

switch ($operadores[$operador]) {

    case '/':

        if($op2 != 0)
        {
            $resultado = $op1  / $op2;
        }
        case '-':
            $resultado = $op1  - $op2;

            case '*':
                $resultado = $op1  * $op2;
    
                default:
                $resultado = $op1  + $op2;
                break;
}

echo "La operacion que se realizo fue {$operadores[$operador]} y el resultado fue {$resultado} "

?>