<?php

$nota = 4;
$asistencia = 90;
$falta = 0; // 0 = no ha faltado a la recuperación, 1 = ha faltado

// Primera forma: nota >= 5 Y asistencia >= 80
// Segunda forma: nota >= 4 Y NO haber faltado a la recuperación
$aprueba = ($nota >= 5 && $asistencia >= 80) || ($nota >= 4 && !$falta);

echo "Nota: $nota\n";
echo "Asistencia: $asistencia%\n";
echo "Falta a la recuperación: $falta\n\n";

if ($aprueba) {
    echo "Carlos APRUEBA la asignatura.\n";
} else {
    echo "Carlos NO aprueba la asignatura.\n";
}

?>