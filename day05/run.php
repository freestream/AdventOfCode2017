<?php
$fp             = fopen('input', 'r');
$postion        = 0;
$instructions   = [];

while (false !== ($line = fgets($fp))) {
    $instructions[] = (int) trim($line);
}

$clone      = $instructions;
$firstSteps = 0;
$pointer    = 0;

while ($pointer >= 0 && $pointer < count($clone)) {
    $val = $clone[$pointer];
    $clone[$pointer]++;
    $pointer += $val;

    $firstSteps++;
}

$clone          = $instructions;
$secondSteps    = 0;
$pointer        = 0;

while ($pointer >= 0 && $pointer < count($clone)) {
    $val = $clone[$pointer];

    if ($val >= 3) {
        $clone[$pointer]--;
    } else {
        $clone[$pointer]++;
    }

    $pointer += $val;

    $secondSteps++;
}

echo "It took {$firstSteps} to reached the exit and with the stranger jump technique it tool {$secondSteps}\n";

