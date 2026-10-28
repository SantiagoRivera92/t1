<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hola mundo</title>
</head>

<body>
    
<?php
    function factorialRecursivo($n){
        if ($n == 1){
            return 1;
        } else {
            return $n * factorialRecursivo($n -1);
        }
    }

    /* declaración de variables */
    $n = 170;
    $index = 1;
    $nf = 1;
    do {
        $nf *= $index;
        $index++;
    } while ($index <= $n);
    echo "El factorial de $n es: $nf (Iterativo)";
    echo "<br>";
    $fr = factorialRecursivo($n);
    echo "El factorial de $n es: $fr (Recursivo)";
    echo "<br>";
?>
</body>

</html>