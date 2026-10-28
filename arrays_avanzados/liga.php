<?php
// 1. Array multidimensional y asociativo
// [local][visitante] => [resultado, roja, amarilla, penalti]
$partidos = [
    'Zamora' => [
        'Salamanca'  => ['resultado' => '3-2', 'roja' => 1, 'amarilla' => 0, 'penalti' => 0],
        'Avila'      => ['resultado' => '4-1', 'roja' => 0, 'amarilla' => 0, 'penalti' => 0],
        'Valladolid' => ['resultado' => '1-2', 'roja' => 1, 'amarilla' => 1, 'penalti' => 1],
    ],
    'Salamanca' => [
        'Zamora'     => ['resultado' => '3-2', 'roja' => 1, 'amarilla' => 0, 'penalti' => 0],
        'Avila'      => ['resultado' => '4-1', 'roja' => 0, 'amarilla' => 0, 'penalti' => 0],
        'Valladolid' => ['resultado' => '1-2', 'roja' => 1, 'amarilla' => 2, 'penalti' => 1],
    ],
    'Avila' => [
        'Zamora'     => ['resultado' => '3-2', 'roja' => 1, 'amarilla' => 0, 'penalti' => 2],
        'Salamanca'  => ['resultado' => '1-3', 'roja' => 1, 'amarilla' => 3, 'penalti' => 0],
        'Valladolid' => ['resultado' => '1-3', 'roja' => 1, 'amarilla' => 0, 'penalti' => 1],
    ],
    'Valladolid' => [
        'Zamora'     => ['resultado' => '3-2', 'roja' => 1, 'amarilla' => 0, 'penalti' => 0],
        'Salamanca'  => ['resultado' => '3-1', 'roja' => 0, 'amarilla' => 0, 'penalti' => 0],
        'Avila'      => ['resultado' => '1-2', 'roja' => 1, 'amarilla' => 1, 'penalti' => 2],
    ],
];

$equipos = array_keys($partidos);

// 3. Cálculo de la clasificación a partir del array
$clasificacion = [];
foreach ($equipos as $e) {
    $clasificacion[$e] = ['puntos' => 0, 'gf' => 0, 'gc' => 0];
}

foreach ($partidos as $local => $visitantes) {
    foreach ($visitantes as $visitante => $datos) {
        [$golesLocal, $golesVisitante] = array_map('intval', explode('-', $datos['resultado']));

        $clasificacion[$local]['gf']      += $golesLocal;
        $clasificacion[$local]['gc']      += $golesVisitante;
        $clasificacion[$visitante]['gf']  += $golesVisitante;
        $clasificacion[$visitante]['gc']  += $golesLocal;

        if ($golesLocal > $golesVisitante) {
            $clasificacion[$local]['puntos'] += 3;
        } elseif ($golesLocal < $golesVisitante) {
            $clasificacion[$visitante]['puntos'] += 3;
        } else {
            $clasificacion[$local]['puntos']++;
            $clasificacion[$visitante]['puntos']++;
        }
    }
}

// Ordenar: puntos, y en caso de empate diferencia de goles
uasort($clasificacion, function ($a, $b) {
    return [$b['puntos'], $b['gf'] - $b['gc']] <=> [$a['puntos'], $a['gf'] - $a['gc']];
});
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Liga</title>
<style>
    body { font-family: Arial, sans-serif; margin: 30px; }
    table { border-collapse: collapse; margin-bottom: 40px; }
    th, td { border: 1px solid #ddd; padding: 8px 14px; text-align: center; }
    th.esquina { background: red; color: #800; }
    .resultado { background: lightgreen; padding: 2px 14px; margin-bottom: 4px; }
    .tarjetas { display: flex; justify-content: center; gap: 4px; }
    .tarjetas span { padding: 6px 10px; }
    .roja { background: red; }
    .amarilla { background: yellow; }
    .penalti { background: orange; }
</style>
</head>
<body>
<h1>Liga de fútbol</h1>
<h2>Resultados</h2>
<table>
    <tr>
        <th class="esquina">Equipos</th>
        <?php foreach ($equipos as $equipo): ?>
            <th><?= $equipo ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($equipos as $local): ?>
        <tr>
            <th><?= $local ?></th>
            <?php foreach ($equipos as $visitante): ?>
                <td>
                <?php if (isset($partidos[$local][$visitante])): $p = $partidos[$local][$visitante]; ?>
                    <div class="resultado"><?= $p['resultado'] ?></div>
                    <div class="tarjetas">
                        <span class="roja"><?= $p['roja'] ?></span>
                        <span class="amarilla"><?= $p['amarilla'] ?></span>
                        <span class="penalti"><?= $p['penalti'] ?></span>
                    </div>
                <?php endif; ?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Clasificación</h2>
<table>
    <tr>
        <th>Equipos</th>
        <th>Puntos</th>
        <th>Goles a favor</th>
        <th>Goles en contra</th>
    </tr>
    <?php foreach ($clasificacion as $equipo => $c): ?>
        <tr>
            <th><?= $equipo ?></th>
            <td><?= $c['puntos'] ?></td>
            <td><?= $c['gf'] ?></td>
            <td><?= $c['gc'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>