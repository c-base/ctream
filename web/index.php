<?php
$loader = require dirname(__DIR__) . '/vendor/autoload.php';

$app = require dirname(__DIR__) . '/bootstrap.php';
$app->run();