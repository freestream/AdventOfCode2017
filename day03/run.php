<?php
$input = '347991';

$anserOne = solutionOne($input);
$anserTwo = solutionTwo($input);

echo "{$anserOne} steps are required to carry the data and the first value written that is larger than the puzzle input is {$anserTwo}\n";

function solutionOne($input)
{
    $x    = 0;
    $y    = 0;
    $dir  = 'R';
    $data = [];

    for ($i = 1; $i < $input; $i++) {
        if (!isset($data[$y])) {
            $data[$y] = [];
        }

        $data[$y][$x] = $i;

        if ($i > 1) {
            if ($dir === 'R' && (!isset($data[$y - 1]) || !isset($data[$y - 1][$x]))) {
                $dir = 'U';
            } else if ($dir === 'U' && !isset($data[$y][$x - 1])) {
                $dir = 'L';
            } else if ($dir === 'L' && (!isset($data[$y + 1]) || !isset($data[$y + 1][$x]))) {
                $dir = 'D';
            } else if ($dir === 'D' && !isset($data[$y][$x + 1])) {
                $dir = 'R';
            }
        }

        switch ($dir) {
            case 'L':
                $x--;
                break;
            case 'R':
                $x++;
                break;
            case 'U':
                $y--;
                break;
            case 'D':
                $y++;
                break;
        }
    }

    return abs($x) + abs($y);
}

function solutionTwo($input)
{
    $x      = 0;
    $y      = 0;
    $dir    = 'R';
    $data   = [];

    for ($i = 1;; $i++) {
        $value = 0;

        if (isset($data[$y]) && isset($data[$y][$x + 1])) {
            $value += $data[$y][$x+1];
        }

        if (isset($data[$y]) && isset($data[$y][$x-1])) {
            $value += $data[$y][$x-1];
        }

        if (isset($data[$y+1]) && isset($data[$y+1][$x])) {
            $value += $data[$y+1][$x];
        }

        if (isset($data[$y+1]) && isset($data[$y+1][$x+1])) {
            $value += $data[$y+1][$x+1];
        }

        if (isset($data[$y+1]) && isset($data[$y+1][$x-1])) {
            $value += $data[$y+1][$x-1];
        }

        if (isset($data[$y-1]) && isset($data[$y-1][$x])) {
            $value += $data[$y-1][$x];
        }

        if (isset($data[$y-1]) && isset($data[$y-1][$x+1])) {
            $value += $data[$y-1][$x+1];
        }

        if (isset($data[$y-1]) && isset($data[$y-1][$x-1])) {
            $value += $data[$y-1][$x-1];
        }

        if ($i === 1) {
            $value = $i;
        }

        if (!isset($data[$y])) {
            $data[$y] = [];
        }

        $data[$y][$x]   = $value;

        if ($value > $input) {
            return $value;
        }

        if ($i > 1) {
            if ($dir === 'R' && (!isset($data[$y - 1]) || !isset($data[$y - 1][$x]))) {
                $dir = 'U';
            } else if ($dir === 'U' && !isset($data[$y][$x - 1])) {
                $dir = 'L';
            }  else if ($dir === 'L' && (!isset($data[$y + 1]) || !isset($data[$y + 1][$x]))) {
                $dir = 'D';
            } else if ($dir === 'D' && !isset($data[$y][$x + 1])) {
                $dir = 'R';
            }
        }

        switch ($dir) {
            case 'L':
                $x--;
                break;
            case 'R':
                $x++;
                break;
            case 'U':
                $y--;
                break;
            case 'D':
                $y++;
                break;
        }
    }
}


