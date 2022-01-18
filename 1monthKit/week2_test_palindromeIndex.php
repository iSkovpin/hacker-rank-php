<?php


/*
 * Complete the 'palindromeIndex' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts STRING s as parameter.
 */

function palindromeIndex($s)
{
    $excessIndex = -1;
    $half = floor(strlen($s) / 2);

    if ($half < 1) {
        return $excessIndex;
    }

    $debugExcessIndex = function ($str, $index, $i, $j) {
        echo "Excess index: $index ($str[$index]) ~ ";
        $range = array_merge(range($i - 3, $i + 3), [null], range($j + 3, $j - 3, -1));

        foreach ($range as $idx) {
            if ($idx === null) {
                echo ' ';
                continue;
            }

            if (isset($str[$idx])) {
                $letter = $str[$idx];
                if ($idx === $index) {
                    $letter = strtoupper($letter);
                }

                echo $letter;
            }
        }
        echo "\n";
    };

    $excessIndex = -1;
    for ($i = 0, $j = strlen($s) - 1; $j - $i > 0; $i++, $j--) {
        // If letters are the same - go forward
        if ($s[$i] === $s[$j]) {
            continue;
        }

        // If potential excess index has already been found,
        // one more mismatch tells that the $s string can't be transformed to a palindrome by only one replace
        if ($excessIndex !== -1) {
            return -1;
        }

        // We should check match of two symbols after potential excess symbol
        // to be sure, that replacing of this symbol can transform the string to a palindrome
        if ($s[$i] === $s[$j - 1] && $s[$i + 1] === $s[$j - 2]) {
            $excessIndex = $j;
//            $debugExcessIndex($s, $excessIndex, $i, $j);
            $i--;
            continue;
        }

        $excessIndex = $i;
//        $debugExcessIndex($s, $excessIndex, $i, $j);
        $j++;
    }

    return $excessIndex;
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$q = intval(trim(fgets(STDIN)));

for ($q_itr = 0; $q_itr < $q; $q_itr++) {
    $s = rtrim(fgets(STDIN), "\r\n");

    $result = palindromeIndex($s);

    fwrite($fptr, $result . "\n");
}

fclose($fptr);
