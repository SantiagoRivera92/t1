<?php
    $viernes =22;
    $sabado = &$viernes;
    $arr = array(
        "Viernes" => &$viernes,
        "Sábado" => &$sabado,
        "Domingo" => &$sabado,
    );
    print_r($arr);
    echo "</br>";
    foreach ($arr as &$cantidad){
        $cantidad *= 2;
    }
    print_r($arr);

?>