<?php

$lines = file('.options');

$csvHeader = [];
$csvData = [];
// collect csvHeader

foreach ($lines as $line) {
    $data = unserialize($line);
    foreach ($data['options'] as $o) {
        $csvHeader[$o['label']] = $o['label'];
    }
}
ksort($csvHeader);
// make data csv
foreach ($lines as $line) {
    $data = unserialize($line);
    $csvDataOneLine = array_combine($csvHeader, array_fill(0, count($csvHeader), ''));

    if (!isset($data['options'])) {
        continue;
    }
    echo "\n\n";
    foreach ($data['options'] as $option) {
        $csvDataOneLine[$option['label']] = $option['value'];
        var_dump($option['label']);
    }
    ksort($csvDataOneLine);
    $csvData[] = $csvDataOneLine;
}

$handle = fopen('.shirts.csv', 'w');
fputcsv($handle, $csvHeader);
foreach ($csvData as $line) {
    fputcsv($handle, $line);
}
fclose($handle);
