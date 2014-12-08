<?php

$app->register(new \CBase\Ctream\Infrastructure\MQTTServiceProvider());
$app->register(new \CBase\Ctream\Infrastructure\ConsoleServiceProvider());

$app->mount('/', new \CBase\Ctream\Application\SiteController());