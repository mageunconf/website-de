<?php
file_put_contents('.options', str_replace("\n\n", '    ', file_get_contents('.options')));
$lines = file('.options');

$csvHeader = [];
$csvData   = [];
// collect csvHeader

foreach ($lines as $line) {
    $data = unserialize(trim($line), ['allow_classes' => false]);
    if(!is_array($data)) {
        var_dump($data, $line);
        die('No array.');
    }
    foreach ($data['options'] as $o) {
        $csvHeader[$o['label']] = $o['label'];
    }
}
ksort($csvHeader);
// make data csv
foreach ($lines as $line) {
    $data           = unserialize($line);
    $csvDataOneLine = array_combine($csvHeader, array_fill(0, count($csvHeader), ''));

    if (!isset($data['options'])) {
        continue;
    }
    #echo "\n\n";
    foreach ($data['options'] as $option) {
        $csvDataOneLine[$option['label']] = $option['value'];
        #var_dump($option['label']);
    }
    ksort($csvDataOneLine);
    $csvData[] = $csvDataOneLine;
}
$time = microtime(true);
$handle = fopen(".shirts-$time.csv", 'wb');
fputcsv($handle, $csvHeader, "\t");
foreach ($csvData as $line) {
    fputcsv($handle, $line, "\t");
}
fclose($handle);
