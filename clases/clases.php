<?php

include_once 'Persona.php';

$santi = new Persona("santi", "rivera", 1992);
$santi->setNombre("santiago");
$santi->setAño(2009);

$serializedSanti = serialize($santi);

echo "<br><br>" . $serializedSanti;

?>