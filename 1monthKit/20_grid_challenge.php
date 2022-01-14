<?php

/*
 * Complete the 'gridChallenge' function below.
 *
 * The function is expected to return a STRING.
 * The function accepts STRING_ARRAY grid as parameter.
 */

function gridChallenge($grid)
{
    $n = count($grid);     // height
    $m = strlen($grid[0]); // width
    $gridArr = [];

    foreach ($grid as $string) {
        $arr = str_split($string);
        sort($arr, SORT_STRING);
        $gridArr[] = $arr;
    }

    for ($i = 0; $i < $m; $i++) {
        for ($j = 1; $j < $n; $j++) {
            if ($gridArr[$j][$i] < $gridArr[$j - 1][$i]) {
                return 'NO';
            }
        }
    }

    return 'YES';
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$t = intval(trim(fgets(STDIN)));

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
    $n = intval(trim(fgets(STDIN)));

    $grid = [];

    for ($i = 0; $i < $n; $i++) {
        $grid_item = rtrim(fgets(STDIN), "\r\n");
        $grid[] = $grid_item;
    }

    $result = gridChallenge($grid);

    fwrite($fptr, $result . "\n");
}

fclose($fptr);
