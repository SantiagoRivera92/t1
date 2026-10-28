<html>

<head>Elvis</head>

<body>
    <?php
    $v1 = true; // 0, vacío
    $v2 = $v1 ?: "Valor por defecto"; //Equivalente a $v1 ?$v1: "Valor por defecto"
    echo $v2;
    ?>
</body>

</html>