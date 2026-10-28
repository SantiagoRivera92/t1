<?php

$a = 12;
$b = 5;

$c = $a % $b;          // resto de 12 / 5 = 2

$a += $c;              // $a = 12 + 2 = 14

$b--;                  // $b = 5 - 1 = 4

$resultado = ($a != $b) && ($c < $b);   // (14 != 4) && (2 < 4)

echo "a = $a<br />";
echo "b = $b<br />";
echo "c = $c<br />";
echo "resultado = $resultado<br />";

?>