<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hola mundo</title>
</head>

<body>
    
<?php
    $arr = [];
    $salir = false;
    for ($i = 0; $i < 10 && !$salir; $i++) {
        $dado = rand(1, 6);
        if ($dado === 5) {
            echo "Sacaste 5 en tu intento número: " . ($i + 1);
            $salir = true;
        }
        $arr[] = $dado;
    }
    if (!$salir){
        echo "Has superado el número de intentos";
    }
    echo "<br>";
    foreach ($arr as $key => $value) {
        echo "<br>Intento " . ($key + 1) . ": " . $value;
    }
?>
</body>

</html>