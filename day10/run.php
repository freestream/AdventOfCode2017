<?php
$content    = file_get_contents('input');
$lengths    = explode(',', $content);
$range      = range(0, 255);
$skipSize   = 0;
$i          = 0;

foreach ($lengths as $length) {
    $length = (int) trim($length);
    $keys   = [];

    foreach (range($i, ($i + $length) - 1) as $idx) {
        $keys[] = ($idx) % count($range);
    }

    $slize      = array_intersect_key(array_replace(array_flip($keys), $range), array_flip($keys));
    $revSlize   = array_reverse($slize, true);
    $revRange   = array_combine(array_keys($slize), array_flip($revSlize));
    $tmpRange   = $range;

    foreach ($revRange as $k => $n) {
        $tmpRange[$k] = $range[$n];
    }

    $range = $tmpRange;

    $i += ($length + $skipSize);

    $skipSize++;
}

list($a, $b) = $range;

$answerOne = $a * $b;

$lengths = array_map('ord', str_split(trim($content)));

array_push($lengths, '17', '31', '73', '47', '23');

$range      = range(0, 255);
$skipSize   = 0;
$i          = 0;

for ($a = 0; $a < 64; $a++) {
    foreach ($lengths as $length) {
        $keys   = [];

        foreach (range($i, ($i + $length) - 1) as $idx) {
            $keys[] = ($idx) % count($range);
        }

        $slize      = array_intersect_key(array_replace(array_flip($keys), $range), array_flip($keys));
        $revSlize   = array_reverse($slize, true);
        $revRange   = array_combine(array_keys($slize), array_flip($revSlize));
        $tmpRange   = $range;

        foreach ($revRange as $k => $n) {
            $tmpRange[$k] = $range[$n];
        }

        $range = $tmpRange;

        $i += ($length + $skipSize);

        $skipSize++;
    }
}

$hash = '';

$chunks = array_chunk($range, 16);

for ($i = 0; $i < 16; $i++) {
    $xor = $chunks[$i][0];

    for ($j = 1; $j < 16; $j++) {
        $xor ^= $chunks[$i][$j];
    }

    $hash .= sprintf('%02s', dechex($xor));
}

echo "Multiplying the first and the second value results in {$answerOne} and the Knot Hash is {$hash}\n";

