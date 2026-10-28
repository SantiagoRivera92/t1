<?php
    $arrayDinero = [500, 200, 100, 50, 20, 10, 5, 2, 1];
    $dinero = 1179;
    echo "La manera más eficiente de dar $dinero es: <br>";
    $billetesYMonedas = [];
    do {
        // Recorremos el array de dinero.
        // Si encontramos una cantidad menor a la que tenemos,
        // la añadimos al array de billetes y monedas y restamos esa cantidad al dinero que nos queda.
        // Después salimos para seguir desde el billete más grande con la nueva cantidad.
        foreach ($arrayDinero as $value) {
            if ($dinero >= $value) {
                $billetesYMonedas[] = $value;
                $dinero -= $value;
                break;
            }
        }
        // Terminamos cuando nos quedan 0€.
    } while ($dinero > 0);

    foreach ($billetesYMonedas as $value) {
        echo "$value<br>";
    }
?>
