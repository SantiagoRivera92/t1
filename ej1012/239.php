<?php
/**
 * Genera una letra aleatoria.
 * $tipo: "mayuscula" o "minuscula"
 */
function letraAleatoria(string $tipo): string
{
    if ($tipo === "mayuscula") {
        return chr(rand(ord('A'), ord('Z')));
    }
    return chr(rand(ord('a'), ord('z')));
}

$resultado = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tipo = $_POST["tipo"] ?? "minuscula";
    $resultado = letraAleatoria($tipo);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generador de letras</title>
</head>
<body>
    <h1>Generador de letra aleatoria</h1>
    <form method="post">
        <label><input type="radio" name="tipo" value="mayuscula" checked> Mayúscula</label>
        <label><input type="radio" name="tipo" value="minuscula"> Minúscula</label>
        <input type="submit" value="Generar">
    </form>
    <?php if ($resultado !== ""): ?>
        <p>Letra generada: <strong style="font-size: 2em;"><?= $resultado ?></strong></p>
    <?php endif; ?>
</body>
</html>