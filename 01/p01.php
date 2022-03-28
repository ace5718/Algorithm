<?php
$in = fopen('1.in', 'r');

// readline()

$data = [];
while (($line = fgets($in)) !== false) {
    $line = trim($line);
    $data[] = preg_replace('/(\ |\-)/', '', $line);
}

for ($i = 1; $i < count($data); $i++) {
    $answer = false;
    if (preg_match('/(978|979)\d{10}/', $data[$i])) {
        $total = 0;
        $isbn = $data[$i];
        for ($j = 0; $j < strlen($isbn) - 1; $j++) {
            $total  += intval($isbn[$j]) * (($j + 1) % 2 == 0 ? 3 : 1);
        }
        $N = $total % 10;
        $answer = ($N == 10 ? 0 : 10 - $N) == $isbn[12];
    }

    echo $answer ? "Y" : "N";
    echo "\n";
}

// var_dump($data);
