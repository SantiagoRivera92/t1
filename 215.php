<?php
    $resultados = [];
    $min = 100;
    $max = 0;
    $suma = 0;
    while (count($resultados) < 33){
        $dado = rand(0, 100);
        $resultados[] = $dado;
        if ($dado < $min){
            $min = $dado;
        }
        if ($dado > $max){
            $max = $dado;
        }
        $suma += $dado;
    }
    echo "El valor máximo es $max <br>";
    echo "El valor mínimo es $min <br>";
    echo "La media es " . ($suma / count($resultados)) . "<br>";
?>