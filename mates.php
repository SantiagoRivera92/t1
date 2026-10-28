<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mates</title>
</head>

<body>
    
<?php
    /* declaración de variables */
    echo "<h2>Numéricas</h2>";
    $a = 1;
    $b = 2;
    echo "a: $a, b: $b";
    echo "<br>";
    $c = $a + $b;
    echo "Suma: $c";
    echo "<br>";
    $c = $a - $b;
    echo "Resta: $c";
    echo "<br>";
    $c = $a * $b;
    echo "Multiplicación: $c";
    echo "<br>";
    $c = $a / $b;
    echo "División: $c";
    echo "<br>";
    $c = $a % $b;
    echo "Módulo: $c";
    echo "<br>";
    $c = $a ** $b;
    echo "Potencia: $c";
    echo "<br>";
    $c = $a == $b;
    echo "<h2>Comparación</h2>";
    echo "Misma referencia?: $c";
    echo "<br>";
    $c = $a === $b;
    echo "Mismo valor?: $c";
    echo "<br>";
    $c = $a > $b;
    echo "$a > $b? $c";
    echo "<br>";
    $c = $a < $b;
    echo "$a < $b? $c";
    echo "<br>";
    $c = $a <=> $b;
    echo "$a <=> $b: $c";
    echo "<br>";
    echo "<h2>Lógicos</h2>";
    $a = true;
    $b = false;
    echo "a: $a, b: $b";
    $c = $a and $b;
    echo "a and b: $c";
    echo "<br>";
    $c = $a or $b;
    echo "a or b: $c";
    echo "<br>";
    $c = $a xor $b;
    echo "a xor b: $c";
    echo "<br>";
    $c = !$a;
    echo "!a: $c";
    echo "<br>";
    echo "<h2>Asignación</h2>";
    $a = 1;
    $b = 2;
    $c = $b;
    echo "c = b: $c";
    echo "<br>";
    $c += $a;
    echo "Asignación suma: $c";
    echo "<br>";
    $c -= $a;
    echo "Asignación resta: $c";
    echo "<br>";
    $c *= $a;
    echo "Asignación multiplicación: $c";
    echo "<br>";
    $c /= $a;
    echo "Asignación división: $c";
    echo "<br>";
    $c %= $a;
    echo "Asignación módulo: $c";
    echo "<br>";
    $c .= $b;
    echo "Asignación concatenación: $c";
    echo "<br>";
    $a++;
    echo "Incremento de a: $a";
    echo "<br>";
    $b--;
    echo "Decremento de b: $b";
?>
</body>

</html>