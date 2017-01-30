<?php

$lines = file('.options');

$csvHeader = [

    "My name as supporter on homepage (. for anonym)"               => "My name as supporter on homepage (. for anonym)",
    "Name on T-Shirt"                                               => "Name on T-Shirt",
    "Company"                                                       => "Company",
    "T-Shirt size (hopefully paid)"                                 => "T-Shirt size (hopefully paid)",
    "Twitter Handle"                                                => "Twitter Handle",
    "github Handle"                                                 => "github Handle",
    "Attendee's eMail Address"                                      => "Attendee's eMail Address",
    "Special needs (vegeterian, vegan, wheelchair, allergies, ...)" => "Special needs (vegeterian, vegan, wheelchair, allergies, ...)",
];
ksort($csvHeader);
$csvData = [];

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
