<?php
$in = fopen('1.in', 'r');

// readline()

$data = [];
while (($line = fgets($in)) !== false) {
    $line = trim($line);
    $data[] = str_split($line);
}

function check($a, $b)
{
    if ($a == ")") return $b == "(";

    if ($a == "]")  return $b == "[";

    if ($a == "}") return $b == "{";

    return false;
}

for ($i = 1; $i < count($data); $i++) {
    $value = $data[$i];
    $answer = count($value) % 2 == 0;

    for ($j = 0; $j < count($value); $j++) {
        if (!$answer) break;

        if ($value[$j] != ")" && $value[$j] != "]" && $value[$j] != "}") continue;

        $answer = false;

        for ($k = $j - 1; $k >= 0; $k--) {
            if (check($value[$j], $value[$k])) {
                $value[$j] = "";
                $value[$k] = "";

                $answer = true;
            }
            
            if ($answer || $value[$k] != "") break;
        }
    }

    echo $answer ? "Y" : "N";
}

// var_dump($data);
