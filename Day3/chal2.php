<?php

$invoer = file_get_contents('input.txt');

if ($invoer === false) {
    die("Error: Unable to read the input file.");
}

$enabled = true;
$sum = 0;

preg_match_all('/(do\(\)|don\'t\(\)|mul\s*\(\s*(\d+)\s*,\s*(\d+)\s*\))/', $invoer, $matches);

foreach ($matches[0] as $match) {
    if (preg_match('/do\(\)/', $match)) {
        $enabled = true;
    } elseif (preg_match('/don\'t\(\)/', $match)) {
        $enabled = false;
    } elseif ($enabled && preg_match('/mul\s*\(\s*(\d+)\s*,\s*(\d+)\s*\)/', $match, $mulMatch)) {
        $x = (int)$mulMatch[1];
        $y = (int)$mulMatch[2];
        $sum += $x * $y;
    }
}

echo $sum;
?>
