<?php
/**
 * Librería propia de validación de formularios.
 * Cada validador devuelve null si el valor es correcto
 * o un string con el mensaje de error si no lo es.
 */

// ---------- Utilidades ----------

/** Recoge un campo de $_POST (sin espacios sobrantes). */
function post(string $campo): string
{
    return trim((string)($_POST[$campo] ?? ''));
}

/** Escapa para mostrar en HTML (evita XSS). */
function h(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

/** Pinta el mensaje de error en rojo junto al campo. */
function mostrarError(array $errores, string $campo): string
{
    return isset($errores[$campo])
        ? '<span class="error">&lt;-- ' . h($errores[$campo]) . '</span>'
        : '';
}

// ---------- Textos ----------

/** No vacío y con un mínimo de caracteres. */
function validarTexto(string $v, int $min = 1, string $etiqueta = 'un valor'): ?string
{
    if ($v === '') {
        return "Debe introducir $etiqueta!!";
    }
    if (mb_strlen($v) < $min) {
        return "Mínimo $min caracteres";
    }
    return null;
}

/** Solo letras y espacios. Si no es obligatorio, vacío es válido. */
function validarAlfabetico(string $v, bool $obligatorio = true, int $min = 1, string $etiqueta = 'un valor'): ?string
{
    if ($v === '') {
        return $obligatorio ? "Debe introducir $etiqueta!!" : null;
    }
    if (!preg_match('/^[\p{L} ]+$/u', $v)) {
        return 'Solo se permiten letras';
    }
    return mb_strlen($v) < $min ? "Mínimo $min caracteres" : null;
}

/** Letras, números y espacios. */
function validarAlfanumerico(string $v, bool $obligatorio = true, string $etiqueta = 'un valor'): ?string
{
    if ($v === '') {
        return $obligatorio ? "Debe introducir $etiqueta!!" : null;
    }
    return preg_match('/^[\p{L}\p{N} ]+$/u', $v) ? null : 'Solo se permiten letras y números';
}

/** Primer apellido (mín. 3), un espacio, segundo apellido (mín. 3). */
function validarApellidos(string $v): ?string
{
    if ($v === '') {
        return 'Debe introducir los apellidos!!';
    }
    if (!preg_match('/^\p{L}{3,} \p{L}{3,}$/u', $v)) {
        return 'Formato: primer apellido (mín. 3), un espacio y segundo apellido (mín. 3)';
    }
    return null;
}

// ---------- Fecha, DNI, email, teléfono, contraseña ----------

/** Fecha en formato dd/mm/aaaa. Opcionalmente exige mayoría de edad. */
function validarFecha(string $v, bool $obligatorio = true, bool $mayorEdad = false): ?string
{
    if ($v === '') {
        return $obligatorio ? 'Debe introducir una fecha (dd/mm/aaaa)!!' : null;
    }
    if (!preg_match('#^(\d{2})/(\d{2})/(\d{4})$#', $v, $m)) {
        return 'Formato incorrecto, use dd/mm/aaaa';
    }
    [, $dia, $mes, $anio] = array_map('intval', $m);
    if (!checkdate($mes, $dia, $anio)) {
        return 'La fecha no existe';
    }
    if ($mayorEdad) {
        $fecha = new DateTime(sprintf('%04d-%02d-%02d', $anio, $mes, $dia));
        $hoy = new DateTime('today');
        if ($fecha > $hoy) {
            return 'La fecha no puede ser futura';
        }
        if ($fecha->diff($hoy)->y < 18) {
            return 'Debe ser mayor de edad';
        }
    }
    return null;
}

/** DNI: 8 dígitos + letra correcta (número % 23). */
function validarDNI(string $v): ?string
{
    if ($v === '') {
        return 'Debe introducir un DNI!!';
    }
    $v = strtoupper($v);
    if (!preg_match('/^(\d{8})([A-Z])$/', $v, $m)) {
        return 'El DNI debe tener 8 dígitos y una letra';
    }
    $letra = substr('TRWAGMYFPDXBNJZSQVHLCKE', (int)$m[1] % 23, 1);
    return $m[2] === $letra ? null : 'La letra del DNI no es correcta';
}

/** Email: 1+ caracteres, @, 1+ caracteres, punto y 2+ caracteres. */
function validarEmail(string $v): ?string
{
    if ($v === '') {
        return 'Debe introducir un correo electrónico!!';
    }
    return preg_match('/^[^@\s]+@[^@\s]+\.[^@\s.]{2,}$/', $v) ? null : 'Correo electrónico no válido';
}

/** Teléfono español: 9 dígitos empezando por 6, 7, 8 o 9. */
function validarTelefono(string $v): ?string
{
    if ($v === '') {
        return 'Debe introducir un teléfono!!';
    }
    return preg_match('/^[6-9]\d{8}$/', $v) ? null : 'Teléfono no válido (9 dígitos)';
}

/** Contraseña: mínimo 8 caracteres, con al menos una letra y un número. */
function validarPassword(string $v): ?string
{
    if ($v === '') {
        return 'Debe introducir una contraseña!!';
    }
    if (strlen($v) < 8 || !preg_match('/[A-Za-z]/', $v) || !preg_match('/\d/', $v)) {
        return 'Mínimo 8 caracteres, con letras y números';
    }
    return null;
}

// ---------- Selección ----------

/** Radio obligatorio: debe estar marcado y ser una opción válida. */
function validarRadio(string $v, array $permitidos): ?string
{
    if ($v === '') {
        return 'Debe elegir una opción!!';
    }
    return in_array($v, $permitidos, true) ? null : 'Opción no válida';
}

/** Combo: no se puede dejar la primera opción (valor vacío). */
function validarCombo(string $v, array $permitidos): ?string
{
    if ($v === '' || !in_array($v, $permitidos, true)) {
        return 'Debe elegir una opción distinta de la primera!!';
    }
    return null;
}

/** Checkboxes: número mínimo y máximo de marcados. */
function validarChecks(array $seleccion, int $min, int $max, array $permitidos): ?string
{
    if (array_diff($seleccion, $permitidos)) {
        return 'Opción no válida';
    }
    $n = count($seleccion);
    if ($n < $min || $n > $max) {
        return "Elija al menos $min y como máximo $max";
    }
    return null;
}

// ---------- Ficheros ----------

/** Valida un fichero subido (extensión y tamaño). */
function validarFichero(string $campo, bool $obligatorio, array $extensiones, int $maxBytes): ?string
{
    if (!isset($_FILES[$campo]) || $_FILES[$campo]['error'] === UPLOAD_ERR_NO_FILE) {
        return $obligatorio ? 'Debe subir un documento!!' : null;
    }
    if ($_FILES[$campo]['error'] !== UPLOAD_ERR_OK) {
        return 'Error al subir el archivo';
    }
    if ($_FILES[$campo]['size'] > $maxBytes) {
        return 'El archivo es demasiado grande';
    }
    $ext = strtolower(pathinfo($_FILES[$campo]['name'], PATHINFO_EXTENSION));
    return in_array($ext, $extensiones, true)
        ? null
        : 'Extensión no permitida (' . implode(', ', $extensiones) . ')';
}

/** Guarda el fichero en $dir y devuelve el nombre con el que se guardó. */
function guardarFichero(string $campo, string $dir): string
{
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $nombre = uniqid() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', basename($_FILES[$campo]['name']));
    move_uploaded_file($_FILES[$campo]['tmp_name'], "$dir/$nombre");
    return $nombre;
}