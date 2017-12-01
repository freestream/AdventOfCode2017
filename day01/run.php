<?php
$content    = file_get_contents('input');
$chars      = array_map('intval', str_split(trim($content)));
$firstSum   = 0;
$secSum     = 0;
$charCnt    = count($chars);

foreach ($chars as $i => $char) {
    if ($i === $charCnt-1) {
        $firstComp = $chars[0];
    } else {
        $firstComp = $chars[$i+1];
    }

    $secComp    = $i + ($charCnt / 2);
    $rest       = $secComp - $charCnt;

    if ($rest >= 0) {
        $idx = $rest;
    } else {
        $idx = $secComp;
    }

    if ($chars[$idx] === $char) {
        $secSum += $char;
    }

    if ($char === $firstComp) {
        $firstSum += $char;
    }
}

echo "The answer for the first 50% is {$firstSum} and the to complete the captcha the answer is {$secSum}\n";

