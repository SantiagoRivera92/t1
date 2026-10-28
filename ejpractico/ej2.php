<?php
function generaNumerosAleatorios(&$array, $min, $max, $num, $repeat): array
{
    if ($num > ($max - $min + 1) && !$repeat) {
        return false;
    }
    for ($i = 0; $i<$num; $i++){
        $rand = 0;
        if (!$repeat){
            $repeated = false;
            do {
                $rand = rand($min, $max);
                $repeated = in_array($rand, $array);
            } while ($repeated);
            $array[$i] = $rand;
        } else {
            $array[$i] = rand($min, $max);
        }
    }
    return true;
}
?>