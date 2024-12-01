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

sort($leftList);
sort($rightList);

$totalVerschil = array();
for ($i = 0; $i < count($leftList); $i++) {
    $result = abs($leftList[$i] - $rightList[$i]);
    echo('Verschil: ' . $result . PHP_EOL);
    $totalVerschil[] = $result;
}

$totalSum = array_sum($totalVerschil);
echo ('Totaal verschil: ' . $totalSum . PHP_EOL);
?>
