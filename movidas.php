<?php
$a = null;
echo "a es null";
echo "<br>";
echo "El valor de a es $a"; // null, no imprime nada
echo "<br>";
$a--;
echo "a--";
echo "<br>";
echo "El valor de a es $a"; // null -1 es null, no imprime nada
echo "<br>";
$a++;
echo "a++";
echo "<br>";
echo "El valor de a es $a"; // null +1 es 1??????????????????, imprime 1
echo "<br>";
$a--;
echo "a--";
echo "<br>";
echo "El valor de a es $a"; // 1 -1 es 0, imprime 0
echo "<br>";
$a--;
echo "a--";
echo "<br>";
echo "El valor de a es $a"; // 0 -1 es -1, imprime -1
echo "<br>";
?>