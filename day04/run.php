<?php
$fp             = fopen('input', 'r');
$firstValid     = 0;
$secondValid    = 0;

while (false !== ($line = fgets($fp))) {
    $groups         = preg_split('/(\s+|\t+)/', trim($line));
    $sorted         = array_map(function($group) {
        $splitted = str_split($group);
        sort($splitted);
        return implode($splitted);
    }, $groups);

    $firstUnique    = array_unique($groups);
    $secondUnique   = array_unique($sorted);

    if (count($groups) === count($firstUnique)) {
        $firstValid++;
    }

    if (count($groups) === count($secondUnique)) {
        $secondValid++;
    }
}

echo "During the initial system policy there is {$firstValid} valid passphrases and under this new system policy there is {$secondValid} valid passphrases.\n";

