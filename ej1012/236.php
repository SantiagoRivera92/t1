<?php
/**
 * Codifica una cadena desplazando cada letra N posiciones en el abecedario.
 * - Desplazamiento 1: A->B, B->C ... Z->A
 * - Respeta espacios, puntos, comas y cualquier carácter que no sea letra.
 * - Mantiene mayúsculas y minúsculas.
 * (Solo se desplazan las letras A-Z / a-z; ñ y vocales con tilde no se alteran.)
 */
function codificar(string $cadena, int $desplazamiento): string
{
    $resultado = "";
    $desplazamiento = $desplazamiento % 26; // si se pasa del abecedario, vuelve a empezar

    for ($i = 0; $i < strlen($cadena); $i++) {
        $c = $cadena[$i];
        $codigo = ord($c);

        if ($codigo >= ord('A') && $codigo <= ord('Z')) {
            $resultado .= chr((($codigo - ord('A') + $desplazamiento) % 26) + ord('A'));
        } elseif ($codigo >= ord('a') && $codigo <= ord('z')) {
            $resultado .= chr((($codigo - ord('a') + $desplazamiento) % 26) + ord('a'));
        } else {
            $resultado .= $c; // espacios, puntos, comas, etc.
        }
    }
    return $resultado;
}

$cadena = "";
$desplazamiento = "";
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cadena = $_POST["cadena"] ?? "";
    $desplazamiento = $_POST["desplazamiento"] ?? "";

    if (!is_numeric($desplazamiento) || (int)$desplazamiento != $desplazamiento) {
        $mensaje = "El desplazamiento debe ser un número entero.";
    } elseif ((int)$desplazamiento < 0) {
        $mensaje = "El desplazamiento no puede ser negativo.";
    } else {
        $mensaje = "Resultado: <strong>" . htmlspecialchars(codificar($cadena, (int)$desplazamiento)) . "</strong>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Codificar</title>
</head>
<body>
    <h1>Codificar cadena</h1>
    <form method="post">
        <p>
            <label>Cadena:
                <input type="text" name="cadena" value="<?= htmlspecialchars($cadena) ?>" size="40">
            </label>
        </p>
        <p>
            <label>Desplazamiento:
                <input type="number" name="desplazamiento" min="0" value="<?= htmlspecialchars((string)$desplazamiento) ?>">
            </label>
        </p>
        <p><input type="submit" value="Codificar"></p>
    </form>
    <p><?= $mensaje ?></p>
</body>
</html>