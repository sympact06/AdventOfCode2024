<?php

$inputfile = file("./input.txt");
$leftList = array();
$rightList = array();

foreach($inputfile as $line){
    $line = trim($line);
    $line = explode(" ", $line);
    $line = array_map('intval', $line);
    $leftList[] = $line[0];
    $rightList[] = $line[3];
}

$similarityScore = 0;

foreach ($leftList as $leftValue) {
    $countInRightList = array_count_values($rightList)[$leftValue] ?? 0;
    $similarityScore += $leftValue * $countInRightList;
}

echo ('Similarity score: ' . $similarityScore . PHP_EOL);
?>
