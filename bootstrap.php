<?php
date_default_timezone_set('UTC');

\Symfony\Component\Debug\Debug::enable();

$environment = getenv('ENVIRONMENT');
$environment = $environment ?: \CBase\Ctream\Application\Application::ENV_DEVELOPMENT;

$app = new \CBase\Ctream\Application\Application(
    [
        'app.root_dir' => __DIR__,
        'app.name' => 'ctream',
        'app.environment' => $environment,
    ]
);

$environmentFile = $app->getConfigDir() . "/" . $environment . ".php";
if (!file_exists($environmentFile)) {
    throw new InvalidArgumentException(sprintf('Environment file for "%s" does not exists', $environment));
}

require $environmentFile;

return $app;
