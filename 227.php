<?php
// Devuelve el mayor de todos los números recibidos (sin usar max())
function mayor()
{
    $numeros = func_get_args();
    $mayor = null;
    foreach ($numeros as $n) {
        if (is_numeric($n) && $n > $mayor) {
            $mayor = $n;
        }
    }
    return $mayor;
}

// Concatena todos los parámetros separados por un espacio
function concatenar(...$palabras)
{
    $resultado = "";
    foreach ($palabras as $i => $palabra) {
        if ($i > 0) {
            $resultado .= " ";
        }
        $resultado .= $palabra;
    }
    return $resultado;
}

function csv($frase)
{
    return str_replace(" ", ";", $frase);
}

echo "El mayor es: " . mayor(4, 17, 9, 23, 5, 34, "pepe") . "<br>";
$palabra = concatenar("Hola", "me", "llamo", "Santi", "y", "estudio", "2º", "de", "DAW");
echo $palabra . "<br>";
echo csv($palabra) . "<br>";
?>