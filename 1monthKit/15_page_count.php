<?php

/*
 * Complete the 'pageCount' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts following parameters:
 *  1. INTEGER n
 *  2. INTEGER p
 */

function pageCount($n, $p)
{
    $spreads = ($n + 2 - ($n % 2)) / 2;
    $pageSpread = ($p + 2 - ($p % 2)) / 2;

    if ($spreads / 2 >= $pageSpread) {
        return $pageSpread - 1;
    }
    return $spreads - $pageSpread;
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$n = intval(trim(fgets(STDIN)));

$p = intval(trim(fgets(STDIN)));

$result = pageCount($n, $p);

fwrite($fptr, $result . "\n");

fclose($fptr);
