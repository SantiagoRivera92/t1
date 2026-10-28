<?php
    $max = isset($_GET["max"]) ? $_GET["max"] : 50;
    $found = [];
    $numbers = [1, 54, 2, 4, 7, 5, 3, 2, 6, 1, 127, 412, 32, 52, 654, 35, 26, 998, 12, 9, 8, 84, 16];
    foreach ($numbers as $number) {
        if ($number <= $max && $number %2 == 0) {
            $found[] = $number;
        }
    }
    foreach ($found as $value) {
        echo "Número par encontrado: $value<br>";
    }
?>