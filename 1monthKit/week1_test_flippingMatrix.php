<?php

/*
 * Complete the 'flippingMatrix' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts 2D_INTEGER_ARRAY matrix as parameter.
 */

function flippingMatrix($matrix) {
    $matrixWidth = count($matrix[0]);
    $circles = $matrixWidth / 2 - 1; // count from 0
    $circleElems = [];

    for ($circle = 0; $circle <= $circles; $circle++) {
        $min = $circle;
        $max = $matrixWidth - 1 - $circle;
        $circleElems[$circle] = [];

        for ($y = $min, $x = $min; $x <= $max; $x++) {
            $circleElems[$circle][] = $matrix[$y][$x];
        }
        for ($y = $max, $x = $min; $x <= $max; $x++) {
            $circleElems[$circle][] = $matrix[$y][$x];
        }
        for ($y = $min + 1, $x = $min; $y <= $max - 1; $y++) {
            $circleElems[$circle][] = $matrix[$y][$x];
        }
        for ($y = $min + 1, $x = $max; $y <= $max - 1; $y++) {
            $circleElems[$circle][] = $matrix[$y][$x];
        }
    }

    $sum = 0;
    foreach ($circleElems as $elems) {
        rsort($elems);
        $sum += array_sum(array_slice($elems, count($elems) / 4)); // max sum of the circle quarter
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
