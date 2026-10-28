<?php

/**
 * Genera una contraseña de $tamanyo caracteres que cumple las necesidades indicadas.
 * Devuelve null si el tamaño es insuficiente para cumplir todos los requisitos.
 */
function generaContrasenya(int $tamanyo, bool $mayusculas, bool $numeros, bool $especiales): ?string
{
    $minusculas = "abcdefghijklmnopqrstuvwxyz";
    $grupos = [$minusculas]; // siempre hay minúsculas
    if ($mayusculas)
        $grupos[] = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    if ($numeros)
        $grupos[] = "0123456789";
    if ($especiales)
        $grupos[] = "!@#$%&*()-_=+[]{}?.,;:";

    if ($tamanyo < count($grupos)) {
        return null;
    }

    $caracteres = [];
    // Garantizamos al menos un carácter de cada grupo exigido
    foreach ($grupos as $grupo) {
        $caracteres[] = $grupo[rand(0, strlen($grupo) - 1)];
    }
    // Rellenamos el resto con caracteres de cualquier grupo
    $todos = implode("", $grupos);
    while (count($caracteres) < $tamanyo) {
        $caracteres[] = $todos[rand(0, strlen($todos) - 1)];
    }
    shuffle($caracteres);
    return implode("", $caracteres);
}

/**
 * Comprueba si una contraseña cumple los criterios. Devuelve la lista de fallos.
 */
function compruebaContrasenya(string $pass, int $tamanyo, bool $mayusculas, bool $numeros, bool $especiales): array
{
    $errores = [];
    if (strlen($pass) < $tamanyo) {
        $errores[] = "Tiene menos de $tamanyo caracteres.";
    }

    $hayMayus = $hayNum = $hayEsp = false;
    for ($i = 0; $i < strlen($pass); $i++) {
        $c = $pass[$i];
        if (ctype_upper($c))
            $hayMayus = true;
        elseif (ctype_digit($c))
            $hayNum = true;
        elseif (!ctype_alpha($c))
            $hayEsp = true;
    }

    if ($mayusculas && !$hayMayus)
        $errores[] = "No contiene mayúsculas.";
    if ($numeros && !$hayNum)
        $errores[] = "No contiene ningún dígito.";
    if ($especiales && !$hayEsp)
        $errores[] = "No contiene ningún carácter especial.";
    return $errores;
}

// --- Lectura del formulario ---
$accion = $_POST["accion"] ?? "";
$tamanyo = (int) ($_POST["tamanyo"] ?? 8);
$mayusculas = isset($_POST["mayusculas"]);
$numeros = isset($_POST["numeros"]);
$especiales = isset($_POST["especiales"]);
$mensaje = "";

if ($accion === "generar") {
    $pass = generaContrasenya($tamanyo, $mayusculas, $numeros, $especiales);
    $mensaje = $pass === null
        ? "El tamaño es demasiado pequeño para cumplir los requisitos."
        : "Contraseña generada: <strong>" . htmlspecialchars($pass) . "</strong>";
} elseif ($accion === "comprobar") {
    $pass = $_POST["contrasenya"] ?? "";
    $errores = compruebaContrasenya($pass, $tamanyo, $mayusculas, $numeros, $especiales);
    if (empty($errores)) {
        $mensaje = "La contraseña cumple todos los criterios.";
    } else {
        $mensaje = "La contraseña no es válida:<ul><li>" . implode("</li><li>", $errores) . "</li></ul>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi contraseña</title>
</head>

<body>
    <h1>Generar y comprobar contraseñas</h1>
    <form method="post">
        <fieldset>
            <legend>Criterios</legend>
            <p><label>Tamaño: <input type="number" name="tamanyo" min="1" value="<?= $tamanyo ?>"></label></p>
            <p><label><input type="checkbox" name="mayusculas" <?= $mayusculas ? "checked" : "" ?>> Contiene
                    mayúsculas</label></p>
            <p><label><input type="checkbox" name="numeros" <?= $numeros ? "checked" : "" ?>> Contiene números</label>
            </p>
            <p><label><input type="checkbox" name="especiales" <?= $especiales ? "checked" : "" ?>> Contiene caracteres
                    especiales</label></p>
        </fieldset>
        <p><button type="submit" name="accion" value="generar">Generar contraseña</button></p>
        <p>
            <label>Escribe tu contraseña:
                <input type="text" name="contrasenya" value="<?= htmlspecialchars($_POST["contrasenya"] ?? "") ?>">
            </label>
            <button type="submit" name="accion" value="comprobar">Comprobar</button>
        </p>
    </form>
    <div><?= $mensaje ?></div>
</body>

</html>