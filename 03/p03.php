<?php
$in = fopen('1.in', 'r');

// readline()

$data = [];
while (($line = fgets($in)) !== false) {
    $line = trim($line);
    $data[] = explode(' ', $line);
}

$direction = [
    [-1, 0],
    [-1, 1],
    [0, 1],
    [1, 1],
    [1, 0],
    [1, -1],
    [0, -1],
    [-1, -1],
];

function check($data, $point)
{
    return ($point[0] >= 0 && $point[0] <= 7) && ($point[1] >= 0 && $point[1] <= 7)
        && $data[$point[0]][$point[1]] == 0;
}

function search($data, $start, $ending, $direction, $array)
{
    $array[] = $start;
    foreach ($direction as $value) {
        if (array_search($ending, $array)) break;

        $point = $start;
        $point[0] += $value[0];
        $point[1] += $value[1];
        if (!array_search($point, $array) && check($data, $point))
            $array = search($data, $point, $ending, $direction, $array);
    }

    return $array;
}

$answer = search($data, [0, 0], [7, 7], $direction, []);

foreach ($answer as $value) {
    echo sprintf("(%d,%d)", $value[0], $value[1]);
    echo "\n";
}

// var_dump($answer);
