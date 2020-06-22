<?php

namespace app\sys;


use app\helpers\ArrayHelper;
use app\sys\cache\MemcacheCache;
use app\sys\db\Connection;
use app\sys\exceptions\ExceptionHandler;

class App
{
    /**
     * @var array
     */
    private $routes;

    /**
     * @var Router
     */
    public $router;

    public function __construct($config, $routes)
    {
        $this->getDBConnection(ArrayHelper::getValue('db', $config));
        $this->getCache(ArrayHelper::getValue('memcached', $config));
        $this->routes = $routes;

        set_exception_handler([ExceptionHandler::class, 'handler']);
    }

    public function run()
    {
        $this->router = new Router($this->routes);

        $controllerClass = $this->router->getControllerClass();
        $method = $this->router->getMethod();
        $params = $this->router->getParams();

        return (new $controllerClass($this, $params))->$method();
    }

    public function getDBConnection($config)
    {
        return Connection::getInstanse($config);
    }

    public function getCache($config)
    {
        return MemcacheCache::getInstanse($config);
    }
}
