<?php
require_once '../Controller/pagination.php';
$pagination = new pagination();
$car = $pagination->getVehicule(1);
// var_dump($car);
require_once '../Model/statistics.php';
$statistics = new Statistics();
echo"<br>";
var_dump($statistics->totalFeedback());


var_dump($statistics->available());

var_dump($statistics->mostRented());

var_dump($statistics->approved());
var_dump($statistics->avrFeedback());






