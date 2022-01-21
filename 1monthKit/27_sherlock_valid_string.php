<?php

/*
 * Complete the 'isValid' function below.
 *
 * The function is expected to return a STRING.
 * The function accepts STRING s as parameter.
 */

function isValid($s) {
    $frequencies = [];

    $len = strlen($s);
    for ($i = 0; $i < $len; $i++) {
        if (!isset($frequencies[$s[$i]])) {
            $frequencies[$s[$i]] = 0;
        }
        $frequencies[$s[$i]]++;
    }

    $frCount = [];
    foreach ($frequencies as $frequency) {
        if (!isset($frCount[$frequency])) {
            $frCount[$frequency] = 0;
        }
        $frCount[$frequency]++;
    }

    if (count($frCount) === 1) {
        return 'YES';
    } elseif(count($frCount) > 2) {
        return 'NO';
    }

    $aloneFrequency = array_search(1, $frCount);
    if ($aloneFrequency === false) {
        return 'NO';
    }

    unset($frCount[$aloneFrequency]);
    $restFrequency = array_keys($frCount)[0];

    if ($aloneFrequency - 1 === 0 || $aloneFrequency - 1 === $restFrequency) {
        return 'YES';
    }
    return 'NO';
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$s = rtrim(fgets(STDIN), "\r\n");

$result = isValid($s);

fwrite($fptr, $result . "\n");

fclose($fptr);
