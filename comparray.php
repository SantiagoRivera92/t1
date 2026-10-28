<?php
    $arr1 = array(
        "pepe" => "3000",
        "ramon" => "4000",
    );
    $arr2 = array(
        "pepe" => 3000,
        "ramon" => 4000,
    );
    $arr3 = array(
        "ramon" => "4000",
        "pepe" => "3000",
    );
    if($arr1 == $arr2){
        echo "arr1 y arr2 son iguales <br>";
    }else{
        echo "arr1 y arr2 no son iguales <br>";
    }
    if($arr1 == $arr3){
        echo "arr1 y arr3 son iguales <br>";
    }else{
        echo "arr1 y arr3 no son iguales <br>";
    }
    if($arr1 === $arr2){
        echo "arr1 y arr2 son idénticos <br>";
    }else{
        echo "arr1 y arr2 no son idénticos <br>";
    }
    if($arr1 === $arr3){
        echo "arr1 y arr3 son idénticos <br>";
    }else{
        echo "arr1 y arr3 no son idénticos <br>";
    }
?>