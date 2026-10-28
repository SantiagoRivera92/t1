<?php

include_once 'ej2.php';

function generaloteria(): array{
    $normales = [];
    $especiales = [];
    generaNumerosAleatorios($normales, 1, 50, 5, false);
    generaNumerosAleatorios($especiales, 1, 12, 2, false);
    $resultados = [];
    $resultados["normales"] = $normales;
    $resultados["especiales"] = $especiales;
    return $resultados;
}

function obtieneseleccionados(): array {
    $isSet = 
        isset($_GET["var1"]) && 
        isset($_GET["var2"]) && 
        isset($_GET["var3"]) &&
        isset($_GET["var4"]) &&
        isset($_GET["var5"]) &&
        isset($_GET["especial1"]) &&
        isset($_GET["especial2"]);
    if ($isSet){
        $normales[0] = $_GET["var1"];
        $normales[1] = $_GET["var2"];
        $normales[2] = $_GET["var3"];
        $normales[3] = $_GET["var4"];
        $normales[4] = $_GET["var5"];
        $especiales[0] = $_GET["especial1"];
        $especiales[1] = $_GET["especial2"];
    } else {
        $normales = [-1, -1, -1, -1, -1];
        $especiales = [-1, -1];
    }
    $seleccionados = [];
    $seleccionados["normales"] = $normales;
    $seleccionados["especiales"] = $especiales;
    return $seleccionados;
}


function generarlayout(): string
{
    $resultados = generaloteria();
    $seleccionados = obtieneseleccionados();

    $mostrar_resultados = $seleccionados["normales"][0] != -1;

    $normales = [];
    $especiales = [];
    $layout = "<div class=\"euromillones\"><h2>Escoge 5 números</h2><table class=\"normales\">";
    
    // Pintamos los números normales
    for ($i = 1; $i<51; $i++){
        $seleccionado = in_array($i, $seleccionados["normales"]);
        $ganador = in_array($i, $resultados["normales"]);
        if (($i-1) % 7 == 0){
            $layout = $layout . "<tr>";
        }
        if ($ganador && $mostrar_resultados){
            $layout = $layout . "<td class=\"normal_ganador\">";
        } else if ($seleccionado){
            $layout = $layout . "<td class=\"normal_seleccionado\">";
        } else {
            $layout = $layout . "<td class=\"normal\">";
        }
        $layout = $layout . $i . "</td>";
    }

    $layout = $layout . "</table><table class=\"especiales\">";

    for ($i = 1; $i<13; $i++){
        $seleccionado = in_array($i, $seleccionados["especiales"]);
        $ganador = in_array($i, $resultados["especiales"]);
        if (($i-1) % 4 == 0){
            $layout = $layout . "<tr>";
        } 
        if ($ganador && $mostrar_resultados){
            $layout = $layout . "<td class=\"especial_ganador\">";
        } else if ($seleccionado){
            $layout = $layout . "<td class=\"especial_seleccionado\">";
        } else {
            $layout = $layout . "<td class=\"especial\">";
        }
        $layout = $layout . $i . "</td>";
    }

    $layout = $layout . "</table></div>";

    // Resumen

    if ($mostrar_resultados){
        $layout = $layout . "<div><h2>Resumen</h2></div>";
        $normales_coincidentes = [];
        foreach($resultados["normales"] as $numero){
            foreach($seleccionados["normales"] as $numero2){
                if ($numero == $numero2){
                    $normales_coincidentes[] = $numero;
                }
            }
        }
        $especiales_coincidentes = [];
        foreach($resultados["especiales"] as $numero){
            foreach($seleccionados["especiales"] as $numero2){
                if ($numero == $numero2){
                    $especiales_coincidentes[] = $numero;
                }
            }
        }
        $layout = $layout . "<div><h3>Números normales coincidentes: " . implode(", ", $normales_coincidentes) . "</h3></div>";
        $layout = $layout . "<div><h3>Números especiales coincidentes: " . implode(", ", $especiales_coincidentes) . "</h3></div>";
    }
    

    return $layout;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicio 3 - Santiago Rivera</title>
    <style>
        body { 
            font-family: system-ui, sans-serif; 
            margin: 2rem auto; 
            padding: 0 1rem; 
        }
        h2 {
            color:white;
        }
        .euromillones {
            background-color:blue;
            max-width: 150px;
            padding:16px;
        }
        .normales {
            display: flex;
        }
        .especiales {
            background-color: aquamarine;
        }
        .normal {
            color: blue;
            background-color: aquamarine;
        }
        .normal_seleccionado {
            color: white;
            background-color: yellow;
        }
        .normal_ganador {
            color: white;
            background-color: green;
        }
        .especial {
            color: blue;
            background-color: aquamarine;
        }
        .especial_seleccionado {
            color: white;
            background-color: yellow;
        }
        .especial_ganador {
            color: white;
            background-color: green;
        }

    </style>
</head>
<body>
    <h1>Euromillones</h1>

    <?= generarlayout() ?>

</body>
</html>