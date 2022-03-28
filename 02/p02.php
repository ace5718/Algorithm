<?php
$in = fopen('1.in', 'r');

// readline()

$data = [];
while (($line = fgets($in)) !== false) {
    $line = trim($line);
    $data[] = $line;
}

$indexs = [];
$values = [];
for ($i = 1; $i <= $data[0]; $i++) {
    $indexs[] = $data[$i];
    $values[$data[$i]] = [];
}
for ($i = $data[0] + 2; $i < count($data); $i++) {
    $value = explode(' ', $data[$i]);
    $values[$value[0]][] = $value;
}

function get_answer($indexs, $values, $i, $string, $total, $array)
{
    if ($i >= count($indexs)) {
        $array[] = [$total, $string];
        return $array;
    }

    foreach ($values[$indexs[$i]] as $value) {
        $string = $string . $value[1] . " ";
        $total += intval($value[2]);

        $array = get_answer($indexs, $values, $i + 1, $string, $total, $array);

        $string = substr($string, 0, strlen($string) - strlen($value[1] . " "));
        $total -= intval($value[2]);
    }
    return $array;
}

function bubble_sort($array)
{
    $count = count($array);
    for ($i = 0; $i < $count; $i++) {
        for ($j = $count - 1; $j > 0; $j--) {
            if ($array[$j][0] < $array[$j - 1][0])
                list($array[$j], $array[$j - 1]) = array($array[$j - 1], $array[$j]);
        }
    }
    return $array;
}

$answer = bubble_sort(get_answer($indexs, $values, 0, '', 0, []));
// foreach ($answer as $value) {
//     echo implode(" ", $value);
//     echo "\n";
// }

var_dump($answer);
