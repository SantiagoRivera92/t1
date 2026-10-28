<?php

// Todas las funciones devuelven "" si el campo es correcto
// o un mensaje de error si no lo es.

function validaNombre($nombre): string
{
    $nombre = trim($nombre);
    if ($nombre === "") {
        return "El nombre es obligatorio.";
    }
    if (!preg_match("/^[\p{L} ]{2,40}$/u", $nombre)) {
        return "El nombre solo puede contener letras (entre 2 y 40).";
    }
    return "";
}

function validaApellidos($apellidos): string
{
    $apellidos = trim($apellidos);
    if ($apellidos === "") {
        return "Los apellidos son obligatorios.";
    }
    if (!preg_match("/^[\p{L} ]{2,60}$/u", $apellidos)) {
        return "Los apellidos solo pueden contener letras (entre 2 y 60).";
    }
    return "";
}

// Formato elegido: dd/mm/aaaa
function validaFecha($fecha): string
{
    $fecha = trim($fecha);
    if ($fecha === "") {
        return "La fecha es obligatoria.";
    }
    if (!preg_match("/^(\d{2})\/(\d{2})\/(\d{4})$/", $fecha, $partes)) {
        return "La fecha debe tener el formato dd/mm/aaaa.";
    }
    if (!checkdate((int)$partes[2], (int)$partes[1], (int)$partes[3])) {
        return "La fecha no existe en el calendario.";
    }
    return "";
}

// Devuelve la letra que corresponde a un número de DNI
function calculaLetraDni($numero): string
{
    $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
    return $letras[((int)$numero) % 23];
}

function validaDni($dni): string
{
    $dni = strtoupper(trim($dni));
    if ($dni === "") {
        return "El DNI es obligatorio.";
    }
    if (!preg_match("/^(\d{8})([A-Z])$/", $dni, $partes)) {
        return "El DNI debe tener 8 números y una letra (ej: 12345678Z).";
    }
    if (calculaLetraDni($partes[1]) !== $partes[2]) {
        return "La letra del DNI no es correcta.";
    }
    return "";
}

function validaAsignaturas($seleccionadas, $permitidas, $minimo = 3): string
{
    if (!is_array($seleccionadas) || count($seleccionadas) < $minimo) {
        return "Debes seleccionar al menos " . $minimo . " asignaturas.";
    }
    foreach ($seleccionadas as $asignatura) {
        if (!in_array($asignatura, $permitidas)) {
            return "Has seleccionado una asignatura no válida.";
        }
    }
    return "";
}

function validaEmail($email): string
{
    $email = trim($email);
    if ($email === "") {
        return "El correo electrónico es obligatorio.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "El correo electrónico no es válido.";
    }
    return "";
}

?>
