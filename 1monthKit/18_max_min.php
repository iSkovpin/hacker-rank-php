<?php

/*
 * Complete the 'maxMin' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts following parameters:
 *  1. INTEGER k
 *  2. INTEGER_ARRAY arr
 */

function maxMin($k, $arr) {
    sort($arr);
    $length = count($arr);

    $unfairness = 0;
    for ($i = 0; $i < $length - ($k - 1); $i++) {
        $curUnfairness = $arr[$i + $k - 1] - $arr[$i];
        if ($curUnfairness < $unfairness || $i === 0) {
            $unfairness = $curUnfairness;
        }
    }

    return $unfairness;
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$n = intval(trim(fgets(STDIN)));

$k = intval(trim(fgets(STDIN)));

$arr = array();

for ($i = 0; $i < $n; $i++) {
    $arr_item = intval(trim(fgets(STDIN)));
    $arr[] = $arr_item;
}

$result = maxMin($k, $arr);

fwrite($fptr, $result . "\n");

fclose($fptr);
