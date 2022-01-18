<?php


/*
 * Complete the 'anagram' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts STRING s as parameter.
 */

function anagram($s)
{
    if (strlen($s) % 2 === 1) {
        return -1;
    }

    $half = strlen($s) / 2;
    $strArr1 = str_split(substr($s, 0, $half));
    $strArr2 = str_split(substr($s, $half));

    foreach ($strArr1 as $letter) {
        $idx = array_search($letter, $strArr2);
        if ($idx === false) {
            continue;
        }
        unset($strArr2[$idx]);
    }

    return count($strArr2);
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$q = intval(trim(fgets(STDIN)));

for ($q_itr = 0; $q_itr < $q; $q_itr++) {
    $s = rtrim(fgets(STDIN), "\r\n");

    $result = anagram($s);

    fwrite($fptr, $result . "\n");
}

fclose($fptr);
