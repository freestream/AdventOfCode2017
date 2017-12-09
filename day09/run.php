<?php
$fp         = fopen('input', 'r');
$prev       = null;
$isGarbage  = false;
$isCanceled = false;
$open       = 0;
$score      = 0;
$chars      = 0;

while (false !== ($char = fgetc($fp))) {
    if (' ' !== $char) {
        $char = trim($char);
    }

    if (!$char) {
        continue;
    }

    if ('!' == $char && false == $isCanceled) {
        $isCanceled = true;
        $prev = $char;
        continue;
    }

    if (true === $isCanceled) {
        $isCanceled = false;
        $prev = $char;
        continue;
    }

    if ('<' === $char) {
        if (true === $isGarbage) {
            $chars++;
        }

        $isGarbage = true;
        $prev = $char;

        continue;
    }

    if (true === $isGarbage) {
        if ('>' === $char) {
            $isGarbage = false;
        } else {
            $chars++;
        }

        $prev = $char;
        continue;
    }

    if ('{' === $char) {
        $open++;
    }

    if ('}' === $char) {
        $score += $open;
        $open--;
    }

    $prev = $char;
}

echo "Total score of all the groups are {$score} and there are {$chars} non-canceled characters within the garbage\n";

