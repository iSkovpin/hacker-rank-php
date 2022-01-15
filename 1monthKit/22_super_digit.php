<?php

/*
 * Complete the 'superDigit' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts following parameters:
 *  1. STRING n
 *  2. INTEGER k
 */

function superDigit($n, $k) {
    $superDigit = array_sum(str_split($n)) * $k;
    if ($superDigit < 10) {
        return $superDigit;
    }

    return superDigit((string) $superDigit, 1);
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$first_multiple_input = explode(' ', rtrim(fgets(STDIN)));

$n = $first_multiple_input[0];

$k = intval($first_multiple_input[1]);

$result = superDigit($n, $k);

fwrite($fptr, $result . "\n");

fclose($fptr);
