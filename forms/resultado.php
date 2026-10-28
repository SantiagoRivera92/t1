<?php
session_start();
require_once 'validaciones.php';

// Si se entra sin haber enviado el formulario, se vuelve al formulario
if (empty($_SESSION['datos'])) {
    header('Location: formulario_registro.php');
    exit;
}

$datos = $_SESSION['datos'];
unset($_SESSION['datos']); // evita reenviar los datos al recargar
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Datos recibidos</title>
<style>
    body { font-family: Arial, sans-serif; margin: 30px; }
    table { border-collapse: collapse; }
    th, td { border: 1px solid #ddd; padding: 8px 14px; text-align: left; }
    th { background: #f2f2f2; }
</style>
</head>
<body>

<h2>Datos recibidos</h2>

<table>
    <?php foreach ($datos as $etiqueta => $valor): ?>
        <?php if ($valor !== ''): // solo los campos utilizados ?>
            <tr>
                <th><?= h($etiqueta) ?></th>
                <td><?= h($valor) ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>

<p><a href="formulario_registro.php">Volver al formulario</a></p>

</body>
</html>