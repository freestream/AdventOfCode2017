<?php
$fp         = fopen('input', 'r');
$firstSum   = 0;
$secSum     = 0;

while (false !== ($line = fgets($fp))) {
    $numbers    = preg_split('/(\s+|\t+)/', trim($line));
    $largest    = max($numbers);
    $smallest   = min($numbers);
    $differance = $largest - $smallest;
    $firstSum   += $differance;

    foreach ($numbers as $i => $n) {
        foreach ($numbers as $j => $k) {
            if ($i === $j) {
                continue;
            }

            if ($n % $k === 0) {
                $secSum += ($n / $k);
            }
        }
    }
}

echo "The checksum for the spreadsheet is {$firstSum} and the sum of each row {$secSum}\n";

