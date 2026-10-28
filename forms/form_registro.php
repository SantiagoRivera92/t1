<?php
session_start();
require_once 'validaciones.php';

$opcionesRadio  = ['Opcion1', 'Opcion2', 'Opcion3'];
$opcionesCombo  = ['Opcion A', 'Opcion B', 'Opcion C']; // la primera opción ("Seleccione") tiene value=""
$opcionesChecks = ['Check1', 'Check2', 'Check3', 'Check4', 'Check5', 'Check6'];
$minChecks = 1;
$maxChecks = 3;

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $checks = (array)($_POST['checks'] ?? []);

    $errores['alfabetico']    = validarAlfabetico(post('alfabetico'), true, 1, 'un nombre');
    $errores['alfabetico_op'] = validarAlfabetico(post('alfabetico_op'), false);
    $errores['alfanumerico']    = validarAlfanumerico(post('alfanumerico'), true, 'un apellido');
    $errores['alfanumerico_op'] = validarAlfanumerico(post('alfanumerico_op'), false);
    $errores['fecha']    = validarFecha(post('fecha'), true);
    $errores['fecha_op'] = validarFecha(post('fecha_op'), false);
    $errores['radio'] = validarRadio(post('radio'), $opcionesRadio);
    $errores['combo'] = validarCombo(post('combo'), $opcionesCombo);
    $errores['checks'] = validarChecks($checks, $minChecks, $maxChecks, $opcionesChecks);
    $errores['telefono'] = validarTelefono(post('telefono'));
    $errores['email']    = validarEmail(post('email'));
    $errores['password'] = validarPassword(post('password'));
    $errores['archivo']  = validarFichero('archivo', false, ['pdf', 'jpg', 'jpeg', 'png', 'txt'], 2 * 1024 * 1024);

    $errores = array_filter($errores);

    if (!$errores) {
        $archivo = '';
        if ($_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
            $archivo = guardarFichero('archivo', __DIR__ . '/uploads');
        }

        // Se guardan todos; resultado.php solo muestra los utilizados
        $_SESSION['datos'] = [
            'Alfabético'            => post('alfabetico'),
            'Alfabético opcional'   => post('alfabetico_op'),
            'Alfanumérico'          => post('alfanumerico'),
            'Alfanumérico opcional' => post('alfanumerico_op'),
            'Fecha'                 => post('fecha'),
            'Fecha opcional'        => post('fecha_op'),
            'Radio'                 => post('radio'),
            'Opción elegida'        => post('combo'),
            'Checks'                => implode(', ', $checks),
            'Teléfono'              => post('telefono'),
            'Email'                 => post('email'),
            'Contraseña'            => '********',
            'Documento'             => $archivo,
        ];
        header('Location: resultado.php');
        exit;
    }
}

// Ayudas para mantener lo que el usuario ya había marcado
function marcado(string $campo, string $valor): string
{
    return post($campo) === $valor ? 'checked' : '';
}
function seleccionado(string $campo, string $valor): string
{
    return post($campo) === $valor ? 'selected' : '';
}
function checkMarcado(string $valor): string
{
    return in_array($valor, (array)($_POST['checks'] ?? []), true) ? 'checked' : '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Formulario de registro</title>
<style>
    body { font-family: Arial, sans-serif; margin: 30px; }
    p { margin: 10px 0; }
    .error { color: red; }
</style>
</head>
<body>

<h2>Formulario de registro</h2>

<form method="post" action="" enctype="multipart/form-data" novalidate>
    <p>Alfabético
        <input type="text" name="alfabetico" placeholder="Nombre" value="<?= h(post('alfabetico')) ?>">
        <?= mostrarError($errores, 'alfabetico') ?></p>

    <p>Alfabético Opcional
        <input type="text" name="alfabetico_op" placeholder="Nombre" value="<?= h(post('alfabetico_op')) ?>">
        <?= mostrarError($errores, 'alfabetico_op') ?></p>

    <p>Alfanumérico
        <input type="text" name="alfanumerico" placeholder="Apellido" value="<?= h(post('alfanumerico')) ?>">
        <?= mostrarError($errores, 'alfanumerico') ?></p>

    <p>Alfanumérico Opcional
        <input type="text" name="alfanumerico_op" placeholder="Apellido" value="<?= h(post('alfanumerico_op')) ?>">
        <?= mostrarError($errores, 'alfanumerico_op') ?></p>

    <p>Fecha
        <input type="text" name="fecha" placeholder="dd/mm/aaaa" value="<?= h(post('fecha')) ?>">
        <?= mostrarError($errores, 'fecha') ?></p>

    <p>Fecha Opcional
        <input type="text" name="fecha_op" placeholder="dd/mm/aaaa" value="<?= h(post('fecha_op')) ?>">
        <?= mostrarError($errores, 'fecha_op') ?></p>

    <p>Radio Obligatorio<br>
        <?php foreach ($opcionesRadio as $o): ?>
            <label><input type="radio" name="radio" value="<?= $o ?>" <?= marcado('radio', $o) ?>> <?= $o ?></label>
        <?php endforeach; ?>
        <?= mostrarError($errores, 'radio') ?></p>

    <p>Elige una opción:
        <select name="combo">
            <option value="">Seleccione</option>
            <?php foreach ($opcionesCombo as $o): ?>
                <option value="<?= $o ?>" <?= seleccionado('combo', $o) ?>><?= $o ?></option>
            <?php endforeach; ?>
        </select>
        <?= mostrarError($errores, 'combo') ?></p>

    <p>Elige al menos <?= $minChecks ?> y máximo <?= $maxChecks ?>:<br>
        <?php foreach ($opcionesChecks as $o): ?>
            <label><input type="checkbox" name="checks[]" value="<?= $o ?>" <?= checkMarcado($o) ?>> <?= $o ?></label>
        <?php endforeach; ?>
        <?= mostrarError($errores, 'checks') ?></p>

    <p>Nº Teléfono
        <input type="text" name="telefono" placeholder="654987321" value="<?= h(post('telefono')) ?>">
        <?= mostrarError($errores, 'telefono') ?></p>

    <p>Email
        <input type="text" name="email" value="<?= h(post('email')) ?>">
        <?= mostrarError($errores, 'email') ?></p>

    <p>Contraseña
        <input type="password" name="password">
        <?= mostrarError($errores, 'password') ?></p>

    <p>Subir documento
        <input type="file" name="archivo">
        <?= mostrarError($errores, 'archivo') ?></p>

    <p><input type="submit" value="Enviar"></p>
</form>

</body>
</html>