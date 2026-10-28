<?php
    $arr = array(
        "España" => "Madrid",
        "Francia" => "París",
        "Italia" => "Roma",
        "Alemania" => "Berlín",
        "Portugal" => "Lisboa",
    );

    foreach ($arr as $k => $v){
        echo "La capital de $k es $v";
        echo "<br>";
    }

?>