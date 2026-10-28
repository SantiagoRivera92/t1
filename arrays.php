<?php
// PR05 - Arrays básicos

$datos = [2, 5, 9, 7, 6, 3, 1, 5, 4, 8, 3, 2, 6, 9, 3, 5, 1, 2, 3];

// Escapa texto antes de mostrarlo en HTML
function h(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

// ---------- Ejercicio 1 ----------
// Ordenar y quitar repetidos
function ejercicio1(array $datos): string
{
    // array_unique quita los repetidos, array_values reindexa y sort ordena
    $sinRepetidos = array_values(array_unique($datos));
    sort($sinRepetidos);

    return "Original:      " . implode(",", $datos) . "\n"
         . "Sin repetidos: " . implode(",", $sinRepetidos);
}

// ---------- Ejercicio 2 ----------
// Buscar los 3 y sustituirlos por su posición
function ejercicio2(array $datos): string
{
    // En PHP los arrays se pasan por valor: $datos es una copia
    $posiciones = [];

    for ($i = 0; $i < count($datos); $i++) {
        if ($datos[$i] === 3) {
            $posiciones[] = $i;
            $datos[$i] = $i;
        }
    }

    return "Posiciones con 3: " . implode(",", $posiciones) . "\n"
         . "Array modificado: " . implode(",", $datos);
}

// ---------- Ejercicio 3 ----------
// Matriz donde cada celda = celda de arriba + celda de la izquierda
function ejercicio3(string $entrada): string
{
    $entrada = trim($entrada);
    if (!ctype_digit($entrada) || (int) $entrada < 1 || (int) $entrada > 20) {
        return "Introduce un tamaño entre 1 y 20.";
    }
    $lado = (int) $entrada;

    $matriz = [];
    for ($i = 0; $i < $lado; $i++) {
        for ($j = 0; $j < $lado; $j++) {
            if ($i === 0 || $j === 0) {
                $matriz[$i][$j] = 1; // primera fila y primera columna
            } else {
                $matriz[$i][$j] = $matriz[$i - 1][$j] + $matriz[$i][$j - 1];
            }
        }
    }

    // Mostrar alineado según el número más grande (la última celda)
    $ancho = strlen((string) $matriz[$lado - 1][$lado - 1]);
    $salida = "";
    for ($i = 0; $i < $lado; $i++) {
        $fila = [];
        for ($j = 0; $j < $lado; $j++) {
            $fila[] = str_pad((string) $matriz[$i][$j], $ancho, " ", STR_PAD_LEFT);
        }
        $salida .= implode(" ", $fila) . "\n";
    }
    return $salida;
}

// ---------- Procesar el formulario ----------
$lado = $_POST["lado"] ?? "";
$resultado3 = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $resultado3 = ejercicio3((string) $lado);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PR05 - Arrays básicos</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 640px; margin: 2rem auto; padding: 0 1rem; }
        h2 { margin-top: 2rem; }
        pre { background: #f2f2f2; padding: 1rem; border-radius: 6px; font-size: 1.05rem; overflow-x: auto; }
        label { display: block; margin: .5rem 0; }
        input[type=number] { padding: .3rem; width: 6rem; }
        button { padding: .4rem 1rem; margin-top: .5rem; }
    </style>
</head>
<body>
    <h1>PR05 - Arrays básicos</h1>

    <h2>Ejercicio 1 - Ordenar sin repetidos</h2>
    <pre><?= h(ejercicio1($datos)) ?></pre>

    <h2>Ejercicio 2 - Sustituir los 3 por su posición</h2>
    <pre><?= h(ejercicio2($datos)) ?></pre>

    <h2>Ejercicio 3 - Matriz</h2>
    <form method="post" action="">
        <label>Tamaño de la matriz (lado)
            <input type="number" name="lado" min="1" max="20" step="1" required value="<?= h((string) $lado) ?>">
        </label>
        <button type="submit">Generar matriz</button>
    </form>
    <?php if ($resultado3 !== null): ?>
        <pre><?= h($resultado3) ?></pre>
    <?php endif; ?>
</body>
</html>