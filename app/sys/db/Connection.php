<?php

namespace app\sys\db;


use app\helpers\ArrayHelper;
use PDO;

class Connection
{
    /**
     * @var PDO
     */
    private static $pdo;

    private function __construct($config)
    {
        static::$pdo = new PDO(
            ArrayHelper::getValue('dsn', $config),
            ArrayHelper::getValue('user', $config),
            ArrayHelper::getValue('password', $config)
        );

        static::$pdo->exec('SET NAMES \'utf8\'');
    }

    /**
     * @param array $config
     * @return PDO
     */
    public static function getInstanse($config = [])
    {
        if (!static::$pdo) {
            new static($config);
        }
        return static::$pdo;
    }
}
