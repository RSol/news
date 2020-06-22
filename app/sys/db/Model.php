<?php


namespace app\sys\db;


use app\helpers\ArrayHelper;
use app\sys\cache\MemcacheCache;
use PDO;

abstract class Model
{
    abstract static function tableName(): string;

    abstract public function createTable();

    abstract public function findAll(QueryLOSParams $params = null);

    abstract public function findOne(int $id);

    abstract public function add();

    abstract public function save(int $id);

    public function __construct()
    {
        $this->createTable();
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return Connection::getInstanse();
    }

    /**
     * @param QueryLOSParams $params
     * @return string
     */
    public function getCacheKeyForList(QueryLOSParams $params)
    {
        $tableName = static::tableName();
        return "{$tableName}_list_{$params}";
    }

    /**
     * @return string
     */
    public function getCacheKeyForTotalCount()
    {
        $tableName = static::tableName();
        return "Total_{$tableName}";
    }

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return MemcacheCache::getOrSet($this->getCacheKeyForTotalCount(), function () {
            $tableName = static::tableName();
            $sql = "SELECT COUNT(id) AS total FROM {$tableName}";
            $query = $this->getConnection()->query($sql);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return (int) ArrayHelper::getValue('total', $result, 0);
        });
    }
}
