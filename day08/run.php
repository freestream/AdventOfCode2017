<?php
$fp         = fopen('input', 'r');
$values     = [];
$heigest    = 0;

while (false !== ($line = fgets($fp))) {
    $line = trim($line);
    preg_match_all('/(\S+)/', $line, $matches);
    $matches = $matches[1];

    list($name, $type, $amount,, $cname, $ctype, $camout) = $matches;

    if (!isset($values[$name])) {
        $values[$name] = 0;
    }

    if (!isset($values[$cname])) {
        $values[$cname] = 0;
    }

    switch($ctype) {
        case '>':
            $isTrue = ($values[$cname] > $camout);
            break;
        case '<':
            $isTrue = ($values[$cname] < $camout);
            break;
        case '>=':
            $isTrue = ($values[$cname] >= $camout);
            break;
        case '==':
            $isTrue = ($values[$cname] == $camout);
            break;
        case '<=':
            $isTrue = ($values[$cname] <= $camout);
            break;
        case '!=':
            $isTrue = ($values[$cname] != $camout);
            break;
    }

    if (true === $isTrue) {
        if ('inc' === $type) {
            $values[$name] += (int) $amount;
        } else {
            $values[$name] -= (int) $amount;
        }
    }

    if ($values[$name] > $heigest) {
        $heigest = $values[$name];
    }
}

$largest = max($values);

echo "In the end the largest value in any register was {$largest} but the highest value during this process was {$heigest}\n";

