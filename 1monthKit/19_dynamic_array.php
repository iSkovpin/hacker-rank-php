<?php

/*
 * Complete the 'dynamicArray' function below.
 *
 * The function is expected to return an INTEGER_ARRAY.
 * The function accepts following parameters:
 *  1. INTEGER n
 *  2. 2D_INTEGER_ARRAY queries
 */

function dynamicArray($n, $queries) {
    $lastAnswer = 0;
    $arrays = array_fill(0, $n, []);
    $answers = [];

    foreach ($queries as $query) {
        list($type, $x, $y) = $query;

        $idx = (($x ^ $lastAnswer) % $n);
        if ($type === 1) {
            $arrays[$idx][] = $y;
        } elseif ($type === 2) {
            $lastAnswer = $arrays[$idx][$y % count($arrays[$idx])];
            $answers[] = $lastAnswer;
        }
    }

    return $answers;
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$first_multiple_input = explode(' ', rtrim(fgets(STDIN)));

$n = intval($first_multiple_input[0]);

$q = intval($first_multiple_input[1]);

$queries = array();

for ($i = 0; $i < $q; $i++) {
    $queries_temp = rtrim(fgets(STDIN));

    $queries[] = array_map('intval', preg_split('/ /', $queries_temp, -1, PREG_SPLIT_NO_EMPTY));
}

$result = dynamicArray($n, $queries);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($fptr);
