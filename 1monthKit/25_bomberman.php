<?php

/*
 * Complete the 'bomberMan' function below.
 *
 * The function is expected to return a STRING_ARRAY.
 * The function accepts following parameters:
 *  1. INTEGER n
 *  2. STRING_ARRAY grid
 */

function bomberMan($n, $grid)
{
    $boom = function ($grid) {
        $yMax = count($grid) - 1;
        $xMax = strlen($grid[0]) - 1;

        foreach ($grid as &$str) {
            $str = strtr($str, '.', 'X');
        }

        for ($y = 0; $y <= $yMax; $y++) {
            for ($x = 0; $x <= $xMax; $x++) {
                if ($grid[$y][$x] !== 'O') {
                    continue;
                }
                $grid[$y][$x] = '.';

                $explosion = [
                    [$y, $x - 1],
                    [$y, $x + 1],
                    [$y - 1, $x],
                    [$y + 1, $x],
                ];

                foreach ($explosion as $yx) {
                    if ($yx[0] < 0 || $yx[1] < 0 || $yx[0] > $yMax || $yx[1] > $xMax) {
                        continue;
                    } elseif ($grid[$yx[0]][$yx[1]] !== 'X') {
                        continue;
                    }
                    $grid[$yx[0]][$yx[1]] = '.';
                }
            }
        }

        foreach ($grid as &$str) {
            $str = strtr($str, 'X', 'O');
        }
        return $grid;
    };

    $plant = function ($grid) {
        return array_fill(0, count($grid), str_repeat('O', strlen($grid[0])));
    };

    if ($n === 1) {
        echo 'init';
        return $grid;
    } elseif ($n % 2 === 0) {
        echo 'full';
        return $plant($grid);
    } elseif (($n - 1) % 4 === 0) {
        echo 'boom boom';
        return $boom($boom($grid));
    }
    echo 'boom';
    return $boom($grid);
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$first_multiple_input = explode(' ', rtrim(fgets(STDIN)));

$r = intval($first_multiple_input[0]);

$c = intval($first_multiple_input[1]);

$n = intval($first_multiple_input[2]);

$grid = [];

for ($i = 0; $i < $r; $i++) {
    $grid_item = rtrim(fgets(STDIN), "\r\n");
    $grid[] = $grid_item;
}

$result = bomberMan($n, $grid);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($fptr);
