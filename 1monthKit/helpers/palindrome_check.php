<?php

function isPalindrome($string): bool
{
    return strrev($string) === $string;
}

$original = "abccba";

$length = strlen($original);
$half = floor($length / 2);

$mismatches = [];
for($i = 0, $j = $length - 1; $i <=$half; $i++, $j--) {
    $a = $original[$i];
    $b = $original[$j];
    if ($a !== $b) {
        $mismatches[] = [$i, $a, $b];
    }
}

foreach ($mismatches as $item) {
    echo "$item[0]: $item[1] $item[2]\n";
}


if (isPalindrome($original)) {
    echo "Palindrome\n";
} else {
    echo "Not a Palindrome\n";
}
