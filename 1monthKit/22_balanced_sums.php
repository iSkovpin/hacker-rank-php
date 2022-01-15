<?php

/*
 * Complete the 'balancedSums' function below.
 *
 * The function is expected to return a STRING.
 * The function accepts INTEGER_ARRAY arr as parameter.
 */

function balancedSums($arr) {
    $sumLeft = 0;
    $sumRight = array_sum($arr);

    $len = count($arr);
    for ($idx = 0; $idx < $len; $idx++) {
        if (isset($arr[$idx - 1])) {
            $sumLeft += $arr[$idx - 1];
        }
        $sumRight -= $arr[$idx];

        if ($sumLeft === $sumRight) {
            return 'YES';
        }
    }

    return 'NO';
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$T = intval(trim(fgets(STDIN)));

for ($T_itr = 0; $T_itr < $T; $T_itr++) {
    $n = intval(trim(fgets(STDIN)));

    $arr_temp = rtrim(fgets(STDIN));

    $arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

    $result = balancedSums($arr);

    fwrite($fptr, $result . "\n");
}

fclose($fptr);
