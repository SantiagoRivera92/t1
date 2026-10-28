<?php
    $a = 4;
    $b = 8;
    $c = 4;

    $discriminante = $b**2 - 4*$a*$c;
    if ($discriminante > 0) {
        $x1 = (-$b + sqrt($discriminante)) / (2*$a);
        $x2 = (-$b - sqrt($discriminante)) / (2*$a);
        echo "Las soluciones son: x<sub>1</sub> = $x1 y x<sub>2</sub> = $x2";
    } else if ($discriminante == 0) {
        $x = -$b / (2*$a);
        echo "La solución es: x = $x";
    } else {
        echo "No hay soluciones reales.";
    }
?>