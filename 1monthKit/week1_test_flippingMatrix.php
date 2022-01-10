<?php

/*
 * Complete the 'flippingMatrix' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts 2D_INTEGER_ARRAY matrix as parameter.
 */

function flippingMatrix($matrix) {
    $getCandidates = function ($matrix, $y, $x) {
        $max = count($matrix[0]) - 1;
        $candidates[] = $matrix[$y][$x];
        $candidates[] = $matrix[$y][$max - $x];
        $candidates[] = $matrix[$max - $y][$x];
        $candidates[] = $matrix[$max - $y][$max - $x];
        return $candidates;
    };

    $half = count($matrix[0]) / 2 - 1;
    $sum = 0;
    for ($y = 0; $y <= $half; $y++) {
        for ($x = 0; $x <= $half; $x++) {
            $sum += max($getCandidates($matrix, $y, $x));
        }
    }

    return $sum;
}

// Tests
//$matrix = [
//    [1, 2, 3, 4],
//    [5, 6, 7, 8],
//    [3, 16, 6, 2],
//    [9, 11, 4, 0],
//];
//
//$matrix2 = [
//    [1, 2, 3, 4, 3, 4],
//    [5, 6, 7, 8, 7, 8],
//    [3, 16, 6, 2, 6, 2],
//    [9, 11, 4, 0, 6, 2],
//    [3, 16, 6, 2, 6, 2],
//    [9, 11, 4, 0, 6, 2],
//];
//
//$sum = flippingMatrix($matrix);
//echo $sum;

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$q = intval(trim(fgets(STDIN)));

for ($q_itr = 0; $q_itr < $q; $q_itr++) {
    $n = intval(trim(fgets(STDIN)));

    $matrix = array();

    for ($i = 0; $i < (2 * $n); $i++) {
        $matrix_temp = rtrim(fgets(STDIN));

        $matrix[] = array_map('intval', preg_split('/ /', $matrix_temp, -1, PREG_SPLIT_NO_EMPTY));
    }

    $result = flippingMatrix($matrix);

    fwrite($fptr, $result . "\n");
}

fclose($fptr);
