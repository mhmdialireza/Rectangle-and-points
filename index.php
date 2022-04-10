<?php

use App\DivideAndConquer;
use App\File;

include './vendor/autoload.php';

$file = new File();
$file->execute();

$rectangle = $file->rectangle;
$points = $file->points;

$divideAndConquer = new DivideAndConquer();
$pointsArray =  $divideAndConquer->execute($rectangle, $points);

$jsonPointsArray = [];
foreach ($pointsArray as $pointArray) {
    $jsonPointsArray[] = json_encode($pointArray);
}
$jsonFilterPoints = array_unique($jsonPointsArray);
$filterPointsCount = count($jsonFilterPoints);

echo  "count: " . $filterPointsCount . PHP_EOL . 'points: ';

$str = '';
foreach ($jsonFilterPoints as $jsonFilterPoint) {
    $point = json_decode($jsonFilterPoint, true);
    $str .= '(' . $point['x'] . ', ' . $point['y'] . '), ';
}

echo trim($str,', ');