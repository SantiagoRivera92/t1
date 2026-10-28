<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mates</title>
</head>

<body>
    <?php
        $a = 12;
        $b = 7;
        echo "a: $a, b: $b";
        echo "<br>";
        if ($a/2 + $b >= 13){
            echo "El resultado es mayor o igual a 13";
        } else {
            echo "El resultado es menor que 13";
        }
        $modulo = $a%$b;
        if ($modulo == 0){
            echo "El resto de $a/$b es 0";
        } else {
            echo "El resto de $a/$b es $modulo";    
        }
    ?>
</body>

</html>