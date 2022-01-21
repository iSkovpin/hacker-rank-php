<?php

/*
 * Complete the 'minimumBribes' function below.
 *
 * The function accepts INTEGER_ARRAY q as parameter.
 */

function minimumBribes($q)
{
    $len = count($q);
    $bribes = 0;
    $steps = [];

    for ($i = 0; $i < $len; $i++) {
        $steps[$i] = $q[$i] - $i - 1;

        if ($steps[$i] === 0) {
            continue;
        } elseif ($steps[$i] > 0) {
            $bribes += $steps[$i];
        } elseif ($steps[$i] < -1) {
            for ($j = $i - 1; $j > $steps[$i] + $i; $j--) {
                if ($steps[$j] <= 0 && $steps[$j] + $j > $steps[$i] + $i) {
                    $bribes++;
                }
            }
        }

        if ($steps[$i] > 2) {
            echo "Too chaotic\n";
            return;
        }
    }

    echo $bribes . "\n";
}

$t = intval(trim(fgets(STDIN)));

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
    $n = intval(trim(fgets(STDIN)));

    $q_temp = rtrim(fgets(STDIN));

    $q = array_map('intval', preg_split('/ /', $q_temp, -1, PREG_SPLIT_NO_EMPTY));

    minimumBribes($q);
}
