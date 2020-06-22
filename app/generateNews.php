<?php

use app\models\News;
use app\sys\App;

require __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/config/main.php';

$localConfigFilePath = __DIR__ . '/config/main-local.php';

if (file_exists($localConfigFilePath)) {
    $config = array_merge(
        $config,
        require $localConfigFilePath
    );
}

(new App($config, $routes));

$model = new News();
for ($i = 1; $i <= 5000; $i++) {
    echo $model->addFake() . "\n";
}

$tableName = News::tableName();
$sql = "INSERT INTO {$tableName} (category_id, title, description, image) SELECT category_id, title, description, image FROM {$tableName} WHERE id <= 5000";
$query = $model->getConnection()->prepare($sql);

for ($i = 1; $i <= 200; $i++) {
    $query->execute();
}
