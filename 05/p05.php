<?php
$in = fopen('3.in', 'r');

// readline()

$data = [];
while (($line = fgets($in)) !== false) {
    $line = trim($line);
    $array = explode(' ', $line);

    if (count($array) <= 1) continue;

    $data[] = [
        $array[0],
        $array[1],
        'total' => 0,
        'string' => sprintf('M%d', count($data) + 1)
    ];
}

function sort_value($index, $data)
{
    $array = [];
    for ($i = 0; $i < count($data); $i++) {
        $array[] = $data[$index];

        $index++;
        if ($index >= count($data)) $index = 0;
    }
    return $array;
}

$answer = [
    'total' => null,
    'string' => '',
];

for ($i = 0; $i < count($data); $i++) {
    $j = 0;
    $value = sort_value($i, $data);
    while (count($value) != 1 && $j < count($data)) {

        $tf = false;
        $min = null;
        $index = 0;

        for ($k = 0; $k < count($value) - 1; $k++) {
            if (
                $value[$k][1] == $value[$k + 1][0] &&
                (is_null($min) ||
                    ($value[$k][0] * $value[$k + 1][0] * $value[$k + 1][1]) < $min)
            ) {
                $min = $value[$k][0] * $value[$k + 1][0] * $value[$k + 1][1];
                $tf = true;
                $index = $k;
            }
        }

        if ($tf) {
            $value[$index] = [
                $value[$index][0],
                $value[$index + 1][1],
                'total' => $min + $value[$index]['total'] + $value[$index + 1]['total'],
                'string' => sprintf('(%s %s)', $value[$index]['string'], $value[$index + 1]['string'])
            ];
            
            unset($value[$index + 1]);
            $value = array_values($value);
            $j = 1;
        } else {
            $value = sort_value($j, $value);
            $j++;
        }
    }

    if (count($value) == 1) {
        if ($value[0]['total'] > $answer['total'] && !is_null($answer['total']))
            continue;

        $answer = [
            'total' => $value[0]['total'],
            'string' => $value[0]['string'],
        ];
    }
}

echo implode("\n", $answer);
