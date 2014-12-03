<?php
date_default_timezone_set('UTC');

\Symfony\Component\Debug\Debug::enable();

$environment = $environment ?:'dev';

$app = new \CBase\Ctream\Application\Application(
    [
        'app.root_dir'      => __DIR__,
        'app.name'          => 'ctream',
        'app.environment'   => $environment,
    ]
);

require $app->getConfigDir() . "/" . $environment . ".php";

return $app;