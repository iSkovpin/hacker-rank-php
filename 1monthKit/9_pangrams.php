<?php

/*
 * Complete the 'pangrams' function below.
 *
 * The function is expected to return a STRING.
 * The function accepts STRING s as parameter.
 */

function pangrams($s) {
    $alphabet = 'abcdefghijklmnopqrstuvwxyz';
    $lettersCount = strlen($alphabet);

    for ($idx = 0; $idx < $lettersCount; $idx++) {
        if (stripos($s, $alphabet[$idx]) === false) {
            return 'not pangram';
        }
    }

    return 'pangram';
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$s = rtrim(fgets(STDIN), "\r\n");

$result = pangrams($s);

fwrite($fptr, $result . "\n");

fclose($fptr);
