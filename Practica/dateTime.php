

<?php

echo "<br />";

$fechaActual = date_create('now')->setTimezone(new DateTimeZone("America/Argentina/Buenos_Aires"))->format("Y - m -d H:i:s ");


// $fechasList = DateTimeZone::listIdentifiers();

// var_dump( $fechasList );

echo $fechaActual;

?>