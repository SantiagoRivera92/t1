<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Investiga funciones de cadena</title>
</head>
<body>
<h1>Funciones de cadena</h1>
<?php
// ucwords(string $string): convierte a mayúscula la primera letra de cada palabra.
$frase = "hola mundo desde php";
echo "<p><strong>ucwords:</strong> " . ucwords($frase) . "</p>"; // Hola Mundo Desde Php

// strrev(string $string): devuelve la cadena invertida (de atrás hacia delante).
$palabra = "reconocer";
echo "<p><strong>strrev:</strong> " . strrev("abcdef") . "</p>"; // fedcba
echo "<p>¿'$palabra' es palíndromo? " . ($palabra === strrev($palabra) ? "Sí" : "No") . "</p>";

// str_repeat(string $string, int $times): repite una cadena un número de veces.
echo "<p><strong>str_repeat:</strong> " . str_repeat("ab-", 4) . "</p>"; // ab-ab-ab-ab-
echo "<p>" . str_repeat("*", 10) . "</p>";

// md5(string $string): calcula el hash MD5 (32 caracteres hexadecimales) de una cadena.
// Siempre da el mismo resultado para la misma entrada. Útil para comprobar integridad;
// NO es seguro para guardar contraseñas (para eso, password_hash).
echo "<p><strong>md5:</strong> md5('hola') = " . md5("hola") . "</p>";
?>
</body>
</html>