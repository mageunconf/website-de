<?php

$images = glob('2017/gallery-images/full/*');

foreach ($images as $image) {
    // gallery-images/full/20160311-19_29_50-0316.jpg
    // 2017/gallery-images/full/20170304-10_46_22-9294.jpg

    $image = substr($image, 5);
    $imageSmall = str_replace('full', '200', $image);

    echo "<a href=\"$image\"><img alt=\"\" src=\"$imageSmall\"/></a>\n";
}
