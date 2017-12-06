<?php
$content    = trim(file_get_contents('input'));
$banks      = array_map('intval', (array) preg_split('/(\s+|\t+)/', (string) $content));
$history    = [];
$cycles     = 0;

do {
    $history[]      = $banks;
    $max            = max($banks);
    $idx            = array_search($max, $banks);
    $banks[$idx]    = 0;

    while ($max > 0) {
        $idx = ($idx + 1) % count($banks);

        $banks[$idx]++;
        $max--;
    }

    $cycles++;
} while (!in_array($banks, $history));

$idx    = array_search($banks, $history);
$size   = count($history) - $idx;

echo "There is {$cycles} redistribution cycles that must be completed and the size of the loop is {$size}\n";

