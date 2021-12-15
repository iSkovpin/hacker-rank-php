<?php

/*
 * Complete the 'plusMinus' function below.
 *
 * The function accepts INTEGER_ARRAY arr as parameter.
 */

function plusMinus($arr) {
    $count = [
        'positive' => 0,
        'negative' => 0,
        'zero'     => 0,
    ];

    foreach ($arr as $value) {
        if ($value > 0) {
            $count['positive']++;
        } elseif ($value < 0) {
            $count['negative']++;
        } else {
            $count['zero']++;
        }
    }

    $arrLen = count($arr);
    $print = function($value) use ($arrLen) {
        if ($arrLen === 0) {
            $arrLen = 1; // to avoid zero dividing
        }
        echo number_format($value / $arrLen, 6, '.', '')  . "\n";
    };

    $print($count['positive']);
    $print($count['negative']);
    $print($count['zero']);
}

$n = intval(trim(fgets(STDIN)));

$arr_temp = rtrim(fgets(STDIN));

$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

plusMinus($arr);
