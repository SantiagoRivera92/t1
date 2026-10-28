<?php

include_once 'ej1.php';

br();
h1("Hola mundo");
br();
p("Esto es un párrafo");
br();
p("Esto es otro párrafo");
br();
$dni = "71173017T";
echo "Mi DNI es " . $dni;
br();
echo "La letra de mi DNI es " . letraDni($dni);

?>