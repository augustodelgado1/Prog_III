
<!-- Aplicación No 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple. 

Augusto Delgado
A332
-->


<?php

$day = date("j/m/y");
$estacion;

switch (date_parse(date("m"))) {
    case 12:
    case 1:
    case 2:
        $estacion = "Invierno";
         break;
    case 3:
    case 4:
    case 5:
        $estacion = "Primavera";
        break;
    case 6:
    case 7:
    case 8:
        $estacion = "Verano";
        break;

    default:
        $estacion = "Otoño";
        break;
}

echo "La fecha de hoy es {$day} y estacion es {$estacion}" ;

?>