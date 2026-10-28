<?php

// Resta 1 punto de cada alumno excepto del alumno con clave 
// $claveAlumno y suma los puntos restados a la nota de ese alumno.
function restanota($claveAlumno, &$notas) {
    $notaAlumno = $notas[$claveAlumno];
    foreach($notas as $clave => &$nota){
        if ($nota > 0 && $clave != $claveAlumno){
            if ($nota < 1){
                $notaAlumno += $nota;
                $nota = 0;
            } else {
                $notaAlumno++;
                $nota--;
            }
            if ($notaAlumno > 10){
                $notaAlumno = 10;
            }
        }
    }
    $notas[$claveAlumno] = $notaAlumno;
}

// Array asociativo. La clave es el nombre del alumno y el valor es la nota.
$alumnos = [
    "Alberto" => 5,
    "Santi" => 7,
    "Javier" => 9,
    "Samuel" => 5.2,
    "Daniel" => 9,
    "Mauro" => 0.1,
    "Héctor" => 0.4
];

restanota("Samuel", $alumnos);
print_r($alumnos);

?>