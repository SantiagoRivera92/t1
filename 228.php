<?php

    function sumar($n1, $n2)
    {
        if (!is_numeric($n1) || !is_numeric($n2)) {
            return "Error: Ambos parámetros deben ser números.";
        }
        return $n1 + $n2;
    }

    function restar($n1, $n2)
    {
        if (!is_numeric($n1) || !is_numeric($n2)) {
            return "Error: Ambos parámetros deben ser números.";
        }
        return $n1 - $n2;
    }

    function multiplicar($n1, $n2)
    {
        if (!is_numeric($n1) || !is_numeric($n2)) {
            return "Error: Ambos parámetros deben ser números.";
        }
        return $n1 * $n2;
    }

    function dividir($n1, $n2)
    {
        if (!is_numeric($n1) || !is_numeric($n2)) {
            return "Error: Ambos parámetros deben ser números.";
        }
        if ($n2 == 0) {
            return "Error: División por cero.";
        }
        return $n1 / $n2;
    }

    echo "10+5: " . sumar(10, 5) . "<br>";
    echo "10-5: " . restar(10, 5) . "<br>";
    echo "10*5: " . multiplicar(10, 5) . "<br>";
    echo "10/5: " . dividir(10, 5) . "<br>";
    echo "10 + \"hola\": " . sumar(10, "hola") . "<br>";
    echo "5/0 = " . dividir(5, 0) . "<br>";
?>