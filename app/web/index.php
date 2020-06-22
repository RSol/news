<?php

use app\sys\App;

require __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../config/main.php';

$localConfigFilePath = __DIR__ . '/../config/main-local.php';

if (file_exists($localConfigFilePath)) {
    $config = array_merge(
        $config,
        require $localConfigFilePath
    );
}

$routes = require __DIR__ . '/../config/routes.php';

echo (new App($config, $routes))->run();
