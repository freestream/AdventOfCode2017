<?php
$fp         = fopen('input', 'r');
$structure  = [];
$tree       = [];
$sizes      = [];

while (false !== ($line = fgets($fp))) {
    $line = trim($line);
    preg_match_all('/([\w\d]+)/', $line, $matches);
    $matches = $matches[1];

    if (count($matches) == 2) {
        list($name, $size) = $matches;
        $holding = [];
    } else {
        list($name, $size) = $matches;
        $holding = array_slice($matches, 2);
    }

    $structure[$name] = [
        'size'      => (int) $size,
        'holding'   => $holding,
    ];
}

$root = '';

foreach ($structure as $name => $data) {
    $doesChance = array_reduce($structure, function($carry, $item) use ($name) {
        if (in_array($name, $item['holding'])) {
            return false;
        }

        return $carry;
    }, true);

    if (true === $doesChance) {
        $root = $name;
    }
}

function makeTree($structure, $root, &$tree)
{
    $size           = $structure[$root]['size'];
    $children       = [];

    foreach ($structure[$root]['holding'] as $child) {
        $childTree = [];

        makeTree($structure, $child, $childTree);

        $children[$child] = $childTree[$child];
    }

    $tree[$root]    = [
        'size'      => getSize($structure, $root),
        'children'  => $children,
    ];
}

function getSize($structure, $root) {
    $parent = $structure[$root];

    if (empty($parent['holding'])) {
        return $parent['size'];
    }

    $size = $parent['size'];

    foreach ($parent['holding'] as $child) {
        $size += getSize($structure, $child);
    }

    return $size;
}

function getImbalancedChild($tree, $structure) {
    foreach ($tree as $pname => $item) {
        $sizes          = [];
        $imbalanced     = false;
        $hasSiblings    = false;
        $isImbalanced   = false;

        if (empty($item['children'])) {
             continue;
        }

        foreach ($item['children'] as $cname => $child) {
            $sizes[$cname] = $child['size'];

            if (!empty($child['children'])) {
                $hasSiblings = true;
            }
        }

        if (1 != count(array_unique($sizes))) {
            $isImbalanced = true;
        }

        if ($isImbalanced && $hasSiblings) {
            $count      = array_flip(array_count_values($sizes));
            $childMap   = array_flip($sizes);
            $oddValue   = $count[1];
            $child      = $childMap[$oddValue];

            if ($result = getImbalancedChild($item['children'][$child]['children'], $structure)) {
                $min        = min($sizes);
                $max        = max($sizes);
                $diff       = $max - $min;
                $size       = $structure[$result]['size'];
                $newSize    = $size - $diff;

                return [
                    'name'      => $result,
                    'new_size'  => $newSize,
                ];
            } else {
                return $child;
            }
        }
    }
}

makeTree($structure, $root, $tree);

$imbalanced = getImbalancedChild($tree, $structure);

$name   = $imbalanced['name'];
$weight = $imbalanced['new_size'];

echo "The name of the bottom program is {$root} and the imbalanced program is {$name} and the weight should be {$weight} to balance the tower\n";

