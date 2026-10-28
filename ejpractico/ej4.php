<?php

include_once 'validaciones.php';

$asignaturas_disponibles = [
    "Programación",
    "Bases de datos",
    "Lenguajes de marcas",
    "Sistemas informáticos",
    "Entornos de desarrollo"
];

// Valores del formulario
$nombre = "";
$apellidos = "";
$fecha = "";
$dni = "";
$asignaturas = [];
$email = "";

$errores = [];
$enviado = $_SERVER["REQUEST_METHOD"] === "POST";

if ($enviado) {
    $nombre = $_POST["nombre"] ?? "";
    $apellidos = $_POST["apellidos"] ?? "";
    $fecha = $_POST["fecha"] ?? "";
    $dni = $_POST["dni"] ?? "";
    $asignaturas = $_POST["asignaturas"] ?? [];
    $email = $_POST["email"] ?? "";

    $errores["nombre"] = validaNombre($nombre);
    $errores["apellidos"] = validaApellidos($apellidos);
    $errores["fecha"] = validaFecha($fecha);
    $errores["dni"] = validaDni($dni);
    $errores["asignaturas"] = validaAsignaturas($asignaturas, $asignaturas_disponibles, 3);
    $errores["email"] = validaEmail($email);

    // Nos quedamos solo con los campos que tienen error
    $errores = array_filter($errores);
}

function muestraError($errores, $campo): void
{
    if (isset($errores[$campo])) {
        echo "<span class=\"error\">" . $errores[$campo] . "</span>";
    }
}

function limpia($valor): string
{
    return htmlspecialchars((string)$valor);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicio 4 - Santiago Rivera</title>
    <style>
        body {
            font-family: system-ui, sans-serif;
            margin: 2rem auto;
            padding: 0 1rem;
            max-width: 480px;
        }
        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }
        .check {
            font-weight: normal;
            margin-top: 4px;
        }
        input[type=text], input[type=email] {
            width: 100%;
            padding: 6px;
            box-sizing: border-box;
        }
        .error {
            color: red;
            font-weight: normal;
            display: block;
        }
        .correcto {
            color: green;
            font-weight: bold;
        }
        button {
            margin-top: 16px;
            padding: 8px 16px;
        }
    </style>
</head>
<body>
    <h1>Formulario</h1>

    <?php if ($enviado && count($errores) == 0): ?>
        <p class="correcto">Formulario correcto. Datos recibidos:</p>
        <ul>
            <li>Nombre: <?= limpia($nombre) ?></li>
            <li>Apellidos: <?= limpia($apellidos) ?></li>
            <li>Fecha: <?= limpia($fecha) ?></li>
            <li>DNI: <?= limpia(strtoupper($dni)) ?></li>
            <li>Asignaturas: <?= limpia(implode(", ", $asignaturas)) ?></li>
            <li>Correo: <?= limpia($email) ?></li>
        </ul>
    <?php endif; ?>

    <form method="post" novalidate>
        <label>Nombre
            <input type="text" name="nombre" value="<?= limpia($nombre) ?>">
            <?php muestraError($errores, "nombre"); ?>
        </label>

        <label>Apellidos
            <input type="text" name="apellidos" value="<?= limpia($apellidos) ?>">
            <?php muestraError($errores, "apellidos"); ?>
        </label>

        <label>Fecha (dd/mm/aaaa)
            <input type="text" name="fecha" placeholder="31/12/2000" value="<?= limpia($fecha) ?>">
            <?php muestraError($errores, "fecha"); ?>
        </label>

        <label>DNI
            <input type="text" name="dni" placeholder="12345678Z" maxlength="9" value="<?= limpia($dni) ?>">
            <?php muestraError($errores, "dni"); ?>
        </label>

        <label>Asignaturas (mínimo 3)</label>
        <?php foreach ($asignaturas_disponibles as $asignatura): ?>
            <label class="check">
                <input type="checkbox" name="asignaturas[]" value="<?= limpia($asignatura) ?>"
                    <?= in_array($asignatura, $asignaturas) ? "checked" : "" ?>>
                <?= limpia($asignatura) ?>
            </label>
        <?php endforeach; ?>
        <?php muestraError($errores, "asignaturas"); ?>

        <label>Correo electrónico
            <input type="email" name="email" value="<?= limpia($email) ?>">
            <?php muestraError($errores, "email"); ?>
        </label>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
