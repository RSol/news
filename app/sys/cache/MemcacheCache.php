<?php
namespace app\sys\cache;

use app\helpers\ArrayHelper;
use Closure;
use Memcache;

class MemcacheCache
{
    /**
     * @var Memcache
     */
    private static $memcache;

    private function __construct($config)
    {
        static::$memcache = new Memcache();
        static::$memcache->connect(
            ArrayHelper::getValue('host', $config),
            ArrayHelper::getValue('port', $config)
        );
    }

    /**
     * @param array $config
     * @return Memcache
     */
    public static function getInstanse($config = [])
    {
        if (!static::$memcache) {
            new static($config);
        }
        return static::$memcache;
    }

    /**
     * @param string $key
     * @param Closure $callback
     * @return array|false|string
     */
    public static function getOrSet($key, $callback) {
        if ($val = static::$memcache->get($key)) {
            return $val;
        }
        $val = $callback();
        static::$memcache->set($key, $val);
        return $val;
    }
}
