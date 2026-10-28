<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Filtrado de números pares</title>
</head>

<body>
    <h1>Filtrado de números pares</h1>

    <form method="POST" action="">
        <p>
            <label>Introduce números separados por espacios:
                <input type="text" name="entrada" size="40"
                    value="<?php echo isset($_POST['entrada']) ? htmlspecialchars($_POST['entrada']) : ''; ?>">
            </label>
            <button type="submit">Filtrar</button>
        </p>
    </form>

    <p id="resultado">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $texto = trim($_POST["entrada"]);

            if ($texto === "") {
                echo "No has introducido ningún número.";
            } else {
                // Separamos por uno o más espacios (usando expresión regular)
                $elementos = preg_split('/\s+/', $texto);
                $numeros = [];
                $hayError = false;

                foreach ($elementos as $elemento) {
                    // Verificamos si es un número entero válido
                    if (is_numeric($elemento)) {
                        $numeros[] = $elemento;
                    } else {
                        $hayError = true;
                        break;
                    }
                }

                if ($hayError) {
                    echo "Solo se permiten números separados por espacios.";
                } else {
                    // Filtramos los números pares (usando módulo)
                    $pares = [];
                    foreach ($numeros as $elemento) {
                        if (fmod($elemento, 2) == 0) {
                            $pares[] = $elemento;
                        }
                    }
                    // Mostramos el resultado
                    if (count($pares) === 0) {
                        echo "No hay números pares.";
                    } else {
                        if (count($pares) === 1) {
                            echo "El único número par es: " . $pares[0];
                        } else {
                            echo "Los " . count($pares) . " números pares son: " . implode(" ", $pares);
                        }
                    }
                }
            }
        }
        ?>
    </p>
</body>

</html>