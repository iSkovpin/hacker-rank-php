<?php

/*
 * Complete the 'counterGame' function below.
 *
 * The function is expected to return a STRING.
 * The function accepts LONG_INTEGER n as parameter.
 */

function counterGame($n)
{
    $turn = 0;
    while (true) {
        $turn++;
        $lg = log($n, 2);

        // if $n is already a power of 2, we don't need more iterations
        if ($n === 1 || floor($lg) === $lg) {
            break;
        }

        $n = $n - pow(2, floor($lg));
    }

    if ($lg % 2 === 0) {
        $turn++;
    }

    return $turn % 2 === 1 ? 'Louise' : 'Richard';
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$t = intval(trim(fgets(STDIN)));

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
    $n = intval(trim(fgets(STDIN)));

    $result = counterGame($n);

    fwrite($fptr, $result . "\n");
}

fclose($fptr);
