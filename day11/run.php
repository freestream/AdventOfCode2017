<?php
$content    = file_get_contents('input');
$moves      = explode(',', trim($content));
$x          = 0;
$y          = 0;
$max        = 0;

foreach ($moves as $move) {
    switch ($move) {
        case 'n':
            $y += 2;
            break;
        case 'ne':
            $y += 1;
            $x++;
            break;
        case 'nw':
            $y += 1;
            $x--;
            break;
        case 's':
            $y -= 2;
            break;
        case 'se':
            $y -= 1;
            $x++;
            break;
        case 'sw':
            $y -= 1;
            $x--;
            break;
    }

    $max = max($max, (abs($x) + abs($y)) / 2);
}

$steps = (abs($x) + abs($y)) / 2;

echo "The fewest number of steps to catch up to him is {$steps} and the furthest he ever got from his starting position is {$max}\n";

