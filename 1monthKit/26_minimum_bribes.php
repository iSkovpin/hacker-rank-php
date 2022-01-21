<?php

/*
 * Complete the 'minimumBribes' function below.
 *
 * The function accepts INTEGER_ARRAY q as parameter.
 */

function minimumBribes($q)
{
    // The decision is based on a consistent pattern I found
    // The number of bribes equal:
    // the sum of positive person shifts (during of $q array sorting)
    // and quantity of negative shifts' crossings

    $len = count($q);
    $bribes = 0;
    $shifts = [];

    for ($i = 0; $i < $len; $i++) {
        // For each element get shift to its final place
        $shifts[$i] = $q[$i] - $i - 1;

        if ($shifts[$i] === 0) {
            continue;
        } elseif ($shifts[$i] > 0) {
            // if a shift is positive, add bribes count
            $bribes += $shifts[$i];
        } elseif ($shifts[$i] < -1) {
            // if a shift is negative, we should make some kind of backtracking
            // from (current index - 1) to a (final index of current person)
            for ($j = $i - 1; $j > $shifts[$i] + $i; $j--) {
                // if some zero or negative shift ends after the (final index of current person)
                // we should add 1 to the bribes counter
                if ($shifts[$j] <= 0 && $shifts[$j] + $j > $shifts[$i] + $i) {
                    $bribes++;
                }
            }
        }

        if ($shifts[$i] > 2) {
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
