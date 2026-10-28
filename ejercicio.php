<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mates</title>
</head>

<body>
    <?php
    $a = 7;
    $b = 4;
    echo "a: $a, b: $b";
    echo "<br>";
    $c = ($a + $b) ** 2;
    $d = $a ** 2;
    $e = $b ** 2;
    $f = $a * $b;
    $g = $c / $f;
    $h = ($d + $e) / $f;
    $i = ($g - $h);
    echo "El resultado es: ";
    var_dump($i);
    echo "<br>";
    $i_redondeado = round($i, 4);
    echo "El valor redondeado es: $i_redondeado";
    echo "<br>";

    if ($i_redondeado > 2) {
        echo "El resultado es mayor que 2";
    } else if ($i_redondeado < 2) {
        echo "El resultado es menor que 2";
    } else {
        echo "El resultado es igual a 2";
    }
    ?>
</body>

</html>