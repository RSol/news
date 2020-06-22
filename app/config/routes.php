<?php

use app\controllers\MainController;
use app\controllers\NewsController;

return [
    '/' => [MainController::class, 'index'],
    '/api/news' => [NewsController::class, 'index'],
    '/api/news/generate' => [NewsController::class, 'create'],
    '/api/news/(\d+)' => [NewsController::class, 'view'],
    '/api/news/flush' => [NewsController::class, 'flush'],
];
