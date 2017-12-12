<?php
$fp         = fopen('input', 'r');
$collection = [];

while (false !== ($line = fgets($fp))) {
    $line = trim($line);
    preg_match_all('/([\d]+)/', $line, $matches);
    $matches = $matches[1];

    $parent     = (int) array_shift($matches);
    $children   = array_map('intval', $matches);

    $collection[$parent] =  array_combine($children, $children);
}

$hashMap = [];

foreach ($collection as $group => $children) {
    $related = isRelatedTo($collection, $group);

    sort($related);

    $hash = implode('-', $related);

    $hashMap[$hash] = $hash;
}

function isRelatedTo($collection, $group, $related = [])
{
    if (!in_array($group, $related)) {
        $related[$group] = $group;

        foreach ($collection[$group] as $child) {
            $related = isRelatedTo($collection, $child, $related);
        }
    }

    return $related;
}

$related    = count(isRelatedTo($collection, 0));
$groups     = count($hashMap);

echo "There is {$related} programs in the 0 group and there is a total of {$groups} groups\n";

