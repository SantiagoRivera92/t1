<?php
/**
 * Genera una contraseña aleatoria de letras (mayúsculas y minúsculas) y dígitos.
 */
function generaContrasenya(int $tamanyo): string
{
    $contrasenya = "";
    for ($i = 0; $i < $tamanyo; $i++) {
        switch (rand(1, 3)) {
            case 1:
                $contrasenya .= chr(rand(ord('A'), ord('Z'))); // mayúscula
                break;
            case 2:
                $contrasenya .= chr(rand(ord('a'), ord('z'))); // minúscula
                break;
            default:
                $contrasenya .= rand(0, 9);                    // dígito
        }
    }
    return $contrasenya;
}

$mensaje = "";
if (isset($_GET["tamanyo"])) { // el tamaño llega por GET
    $tamanyo = (int)$_GET["tamanyo"];
    if ($tamanyo < 1) {
        $mensaje = "El tamaño debe ser mayor que 0.";
    } else {
        $mensaje = "Contraseña generada: <strong>" . htmlspecialchars(generaContrasenya($tamanyo)) . "</strong>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Genera contraseña</title>
</head>
<body>
    <h1>Generador de contraseñas</h1>
    <form method="get">
        <label>Tamaño: <input type="number" name="tamanyo" min="1" value="8"></label>
        <input type="submit" value="Generar">
    </form>
    <p><?= $mensaje ?></p>
</body>
</html>