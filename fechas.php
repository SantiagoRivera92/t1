<?php
// Establecer la zona horaria por defecto para evitar desfases
date_default_timezone_set('Europe/Madrid');

echo "=== EJEMPLO DE FUNCIONES DE FECHA Y HORA EN PHP ===<br><br>";

// 1. time() - Obtiene la marca de tiempo Unix actual (segundos desde el 1 de enero de 1970)
$timestamp_actual = time();
echo "1. time():\n";
echo "   Timestamp Unix actual: " . $timestamp_actual . "<br><br>";

// 2. date() - Formatea una marca de tiempo local legible
echo "2. date():\n";
echo "   Fecha y hora actual formato ISO: " . date("Y-m-d H:i:s") . "<br>";
echo "   Día de la semana actual: " . date("l") . "<br><br>";

// 3. strtotime() - Convierte una descripción textual en inglés a un timestamp
$fecha_relativa = "+2 weeks 3 days";
$timestamp_futuro = strtotime($fecha_relativa);
echo "3. strtotime():\n";
echo "   Analizando '$fecha_relativa': " . date("Y-m-d", $timestamp_futuro) . "<br><br>";

// 4. idate() - Formatea una fecha/hora local como un número entero (ideal para cálculos rápidos)
echo "4. idate():\n";
echo "   Año actual (entero): " . idate('Y') . "<br>";
echo "   Mes actual (entero): " . idate('m') . "<br>";
echo "   Día actual (entero): " . idate('d') . "<br><br>";

// 5. mktime() - Obtiene el timestamp Unix para una fecha y hora específicas
// Sintaxis: mktime(hora, minuto, segundo, mes, día, año)
$timestamp_navidad = mktime(15, 30, 0, 12, 25, 2026);
echo "5. mktime():\n";
echo "   Navidad de 2026 a las 15:30: " . date("Y-m-d H:i:s", $timestamp_navidad) . "<br><br>";

// 6. localtime() - Devuelve los componentes de la hora local en un array
// Pasando 'true' como segundo argumento, devuelve un array asociativo
$info_localtime = localtime(time(), true);
echo "6. localtime():\n";
echo "   Minuto actual (tm_min): " . $info_localtime['tm_min'] . "<br>";
echo "   Hora actual (tm_hour): " . $info_localtime['tm_hour'] . "<br>";
echo "   Año desde 1900 (tm_year): " . $info_localtime['tm_year'] . " (Suma 1900 para obtener el año real)<br><br>";

// 7. getdate() - Devuelve un array asociativo con información detallada de la fecha
$info_getdate = getdate();
echo "7. getdate():\n";
echo "   Mes actual: " . $info_getdate['month'] . "<br>";
echo "   Día del mes: " . $info_getdate['mday'] . "<br>";
echo "   Día de la semana: " . $info_getdate['weekday'] . "<br>";
echo "   Número del día del año: " . $info_getdate['yday'] . "<br>";
?>