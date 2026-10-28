<?php
// PR04 - Operadores y Bucles

// Escapa texto antes de mostrarlo en HTML
function h(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

// Devuelve una línea con $n asteriscos separados por espacio y $sangria espacios delante
function linea(int $n, int $sangria): string
{
    return str_repeat(" ", $sangria) . implode(" ", array_fill(0, $n, "*")) . "\n";
}

// ---------- Ejercicio 1 ----------
function ejercicio1(): string
{
    $anchoMax = 5;
    $salida = "";
    for ($k = 1; $k <= $anchoMax; $k += 2) {
        $salida .= linea($k, $anchoMax - $k);
    }
    return $salida;
}

// ---------- Ejercicio 2 ----------
function ejercicio2(): string
{
    $filas = 5;
    $salida = "";
    // Parte creciente
    for ($k = 1; $k <= $filas; $k += 2) {
        $salida .= linea($k, $filas - $k);
    }
    // Parte decreciente
    for ($k = $filas - 2; $k >= 1; $k -= 2) {
        $salida .= linea($k, $filas - $k);
    }
    return $salida;
}

// ---------- Ejercicio 3 ----------
// Rombo hueco de 5 filas
function ejercicio3(): string
{
    $salida = "";
    $filas = 5;
    for ($i = 0; $i < $filas; $i++) {
        $d = min($i, $filas - 1 - $i); // distancia al extremo
        $sangria = ceil($filas / 2) - 1 - $d;
        if ($d === 0) {
            $salida .= str_repeat(" ", $sangria) . "*\n";
        } else {
            $salida .= str_repeat(" ", $sangria) . "*" . str_repeat(" ", 2 * $d - 1) . "*\n";
        }
    }
    return $salida;
}

// ---------- Ejercicio 4 ----------
function ejercicio4(string $precioTxt, string $pagadoTxt): string
{
    $precioTxt = str_replace(",", ".", trim($precioTxt));
    $pagadoTxt = str_replace(",", ".", trim($pagadoTxt));

    if (!is_numeric($precioTxt) || !is_numeric($pagadoTxt)) {
        return "Introduce importes válidos.";
    }

    if ($precioTxt < 0 || $pagadoTxt < 0) {
        return "Introduce importes no negativos.";
    }

    // Trabajamos en céntimos para evitar errores de decimales
    $cambio = (int) round((float) $pagadoTxt * 100) - (int) round((float) $precioTxt * 100);

    if ($cambio < 0) {
        return "El importe pagado no es suficiente.";
    }
    if ($cambio === 0) {
        return "No hay cambio que devolver.";
    }

    $monedas = [200, 100, 50, 20, 10, 5, 2, 1]; // en céntimos
    $total = 0;
    $salida = "Cambio: " . number_format($cambio / 100, 2) . "€\n";
    foreach ($monedas as $m) {
        $cantidad = intdiv($cambio, $m);
        if ($cantidad > 0) {
            $nombre = $m >= 100 ? ($m / 100) . "€" : $m . " cent";
            $salida .= "$cantidad monedas de $nombre\n";
            $total += $cantidad;
            $cambio -= $cantidad * $m;
        }
    }
    $salida .= "Total de monedas: $total";
    return $salida;
}

// ---------- Ejercicio 5 ----------
function ejercicio5(string $entrada): string
{
    $entrada = trim($entrada);
    if (!ctype_digit($entrada)) {
        return "Año no válido.";
    }

    $anio = (int) $entrada;
    $bisiesto = ($anio % 4 === 0 && $anio % 100 !== 0) || $anio % 400 === 0;
    return "El año $anio " . ($bisiesto ? "es" : "no es") . " bisiesto.";
}

// ---------- Procesar los formularios ----------
$resultado4 = null;
$resultado5 = null;
$precio = $_POST["precio"] ?? "";
$pagado = $_POST["pagado"] ?? "";
$anio = $_POST["anio"] ?? "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (($_POST["ejercicio"] ?? "") === "4") {
        $resultado4 = ejercicio4((string) $precio, (string) $pagado);
    } elseif (($_POST["ejercicio"] ?? "") === "5") {
        $resultado5 = ejercicio5((string) $anio);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PR04 - Operadores y Bucles</title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 640px; margin: 2rem auto; padding: 0 1rem; }
        h2 { margin-top: 2rem; }
        pre { background: #f2f2f2; padding: 1rem; border-radius: 6px; font-size: 1.1rem; }
        label { display: block; margin: .5rem 0; }
        input[type=number] { padding: .3rem; width: 8rem; }
        button { padding: .4rem 1rem; margin-top: .5rem; }
    </style>
</head>
<body>
    <h1>PR04 - Operadores y Bucles</h1>

    <h2>Ejercicio 1</h2>
    <pre><?= h(ejercicio1()) ?></pre>

    <h2>Ejercicio 2</h2>
    <pre><?= h(ejercicio2()) ?></pre>

    <h2>Ejercicio 3</h2>
    <pre><?= h(ejercicio3()) ?></pre>

    <h2>Ejercicio 4 - Cambio</h2>
    <form method="post" action="">
        <input type="hidden" name="ejercicio" value="4">
        <label>Valor del producto (€)
            <input type="number" name="precio" step="0.01" min="0" required value="<?= h((string) $precio) ?>">
        </label>
        <label>Valor con el que paga (€)
            <input type="number" name="pagado" step="0.01" min="0" required value="<?= h((string) $pagado) ?>">
        </label>
        <button type="submit">Calcular cambio</button>
    </form>
    <?php if ($resultado4 !== null): ?>
        <pre><?= h($resultado4) ?></pre>
    <?php endif; ?>

    <h2>Ejercicio 5 - Año bisiesto</h2>
    <form method="post" action="">
        <input type="hidden" name="ejercicio" value="5">
        <label>Año
            <input type="number" name="anio" min="0" step="1" required value="<?= h((string) $anio) ?>">
        </label>
        <button type="submit">Comprobar</button>
    </form>
    <?php if ($resultado5 !== null): ?>
        <pre><?= h($resultado5) ?></pre>
    <?php endif; ?>
</body>
</html>