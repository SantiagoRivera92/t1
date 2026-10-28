<?php

$a = 8;
$b = 3;
$d = 2;

$c = (($a - 2 * $b) >= ($d + 1))    // 8 - 6 = 2 >= 3 → false
     || ($a % 2 == 0)               // 8 % 2 = 0 == 0 → true
     && (($b + 4) != (3 * $d));     // 7 != 6 → true

echo "c = " . var_export($c, true);

?>