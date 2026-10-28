<?php
require_once 'validaciones.php';

$errores = [];
$enviado = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($enviado) {
    $errores['nombre']    = validarTexto(post('nombre'), 3, 'un nombre');
    $errores['apellidos'] = validarApellidos(post('apellidos'));
    $errores['fecha']     = validarFecha(post('fecha'), true, true); // mayor de edad
    $errores['dni']       = validarDNI(post('dni'));
    $errores['email']     = validarEmail(post('email'));

    $errores = array_filter($errores); // deja solo los campos con error
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Formulario y expresiones regulares</title>
<style>
    body { font-family: Arial, sans-serif; margin: 30px; }
    p { margin: 10px 0; }
    label { display: inline-block; width: 110px; }
    .error { color: red; }
    .ok { color: green; font-weight: bold; }
</style>
</head>
<body>

<h2>Formulario</h2>

<?php if ($enviado && !$errores): ?>
    <p class="ok">Todos los datos son correctos.</p>
<?php elseif ($enviado): ?>
    <p class="error">Hay campos incorrectos, revíselos.</p>
<?php endif; ?>

<form method="post" action="" novalidate>
    <p>
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= h(post('nombre')) ?>">
        <?= mostrarError($errores, 'nombre') ?>
    </p>
    <p>
        <label>Apellidos:</label>
        <input type="text" name="apellidos" value="<?= h(post('apellidos')) ?>" placeholder="Pérez López">
        <?= mostrarError($errores, 'apellidos') ?>
    </p>
    <p>
        <label>Fecha:</label>
        <input type="text" name="fecha" value="<?= h(post('fecha')) ?>" placeholder="dd/mm/aaaa">
        <?= mostrarError($errores, 'fecha') ?>
    </p>
    <p>
        <label>DNI:</label>
        <input type="text" name="dni" value="<?= h(post('dni')) ?>" placeholder="12345678Z">
        <?= mostrarError($errores, 'dni') ?>
    </p>
    <p>
        <label>Email:</label>
        <input type="text" name="email" value="<?= h(post('email')) ?>">
        <?= mostrarError($errores, 'email') ?>
    </p>
    <p><input type="submit" value="Enviar"></p>
</form>

</body>
</html>