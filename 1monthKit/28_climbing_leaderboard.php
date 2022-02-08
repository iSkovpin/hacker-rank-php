<?php

/*
 * Complete the 'climbingLeaderboard' function below.
 *
 * The function is expected to return an INTEGER_ARRAY.
 * The function accepts following parameters:
 *  1. INTEGER_ARRAY ranked
 *  2. INTEGER_ARRAY player
 */
function climbingLeaderboard(array $ranked, array $player): array
{
    $rankMap = getRankMap($ranked);
    $result = [];

    foreach ($player as $score) {
        $result[] = getRankBinarySearch($rankMap, $score);
    }

    return $result;
}

function getRankBinarySearch(array $rankMap, int $playerScore): int
{
    $len = count($rankMap);
    $left = 1;
    $right = $len;
    $matchedIndex = -1;

    while ($right - $left > 1) {
        $idx = (int)ceil(($left + $right) / 2);
        $value = $rankMap[$idx];

        if ($value > $playerScore) {
            $left = $idx + 1;
        } else {
            $matchedIndex = $idx;
            $right = $idx - 1;
        }
    }

    if ($rankMap[$right] <= $playerScore) {
        $matchedIndex = $right;
    }
    if ($rankMap[$left] <= $playerScore) {
        $matchedIndex = $left;
    }
    if ($matchedIndex === -1) {
        $matchedIndex = $len + 1;
    }

    return $matchedIndex;
}

function getRankMap(array $ranked): array
{
    $rank = 1;
    $map[$rank] = $ranked[0];

    $len = count($ranked);
    for ($i = 1; $i < $len; $i++) {
        if ($ranked[$i] < $map[$rank]) {
            $rank++;
            $map[$rank] = $ranked[$i];
        }
    }

    return $map;
}


$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$ranked_count = intval(trim(fgets(STDIN)));

$ranked_temp = rtrim(fgets(STDIN));

$ranked = array_map('intval', preg_split('/ /', $ranked_temp, -1, PREG_SPLIT_NO_EMPTY));

$player_count = intval(trim(fgets(STDIN)));

$player_temp = rtrim(fgets(STDIN));

$player = array_map('intval', preg_split('/ /', $player_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = climbingLeaderboard($ranked, $player);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($fptr);
