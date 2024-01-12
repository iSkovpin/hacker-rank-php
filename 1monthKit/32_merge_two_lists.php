<?php

$stdin = fopen("php://stdin", "r");
$stdout = fopen("php://stdout", "w");

/* Enter your code here. Read input from STDIN. Print output to STDOUT */

fscanf($stdin, "%d\n", $testCases);

for ($i = 0; $i < $testCases; $i++) {
    handleTestCase($stdin, $stdout);
}

function handleTestCase($stdin, $stdout): void
{
    fscanf($stdin, "%d\n", $firstListLen);

    $fList = [];
    for ($i = 0; $i < $firstListLen; $i++) {
        fscanf($stdin, "%d\n", $val);
        $fList[$i] = $val;
    }

    fscanf($stdin, "%d\n", $secondListLen);

    $secondList = [];
    for ($i = 0; $i < $secondListLen; $i++) {
        fscanf($stdin, "%d\n", $val);
        $secondList[$i] = $val;
    }

    $res = [];
    $i = 0;
    $j = 0;
    do {
        $first = null;
        $second = null;

        if (isset($fList[$i])) {
            $first = $fList[$i];
        }
        if (isset($secondList[$j])) {
            $second = $secondList[$j];
        }

        if ($first === null && $second === null) {
            break;
        }

        if ($first !== null && $second !== null) {
            if ($first < $second) {
                $res[] = $first;
                $i++;
                continue;
            }
            $res[] = $second;
            $j++;
        } elseif ($first !== null) {
            $res[] = $first;
            $i++;
        } elseif ($second !== null) {
            $res[] = $second;
            $j++;
        }
    } while (true);

    fwrite($stdout, implode(" ", $res) . "\n");
}
