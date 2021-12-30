<?php

/*
 * Complete the 'diagonalDifference' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts 2D_INTEGER_ARRAY arr as parameter.
 */

function diagonalDifference($arr) {
    $width = count($arr[0]);

    $diagSum1 = 0;
    for ($row = 0, $col = 0; $row < $width; $row++, $col++) {
        $diagSum1 += $arr[$row][$col];
    }

    $diagSum2 = 0;
    for ($row = 0, $col = $width - 1; $row < $width; $row++, $col--) {
        $diagSum2 += $arr[$row][$col];
    }

    return abs($diagSum1 - $diagSum2);
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$n = intval(trim(fgets(STDIN)));

$arr = array();

for ($i = 0; $i < $n; $i++) {
    $arr_temp = rtrim(fgets(STDIN));

    $arr[] = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));
}

$result = diagonalDifference($arr);

fwrite($fptr, $result . "\n");

fclose($fptr);
