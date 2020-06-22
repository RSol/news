<?php


namespace app\sys;


use app\helpers\ArrayHelper;
use app\sys\exceptions\RequestUriException;
use app\sys\exceptions\RouteException;

class Router
{
    /**
     * @var string
     */
    private $controllerClass;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $params = [];

    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;

        [$this->controllerClass, $this->method] = $this->getRoute();
        if (!class_exists($this->controllerClass) || !method_exists($this->controllerClass, $this->method)) {
            throw new RouteException('Not Found. Wrong route config', 404);
        }
    }

    private function getRoute()
    {
        if (!$urlString = ArrayHelper::getValue('REQUEST_URI', $_SERVER)) {
            throw new RequestUriException('Something wrong');
        }
        if (strpos($urlString, '?')) {
            [$urlString,] = explode('?', $urlString);
        }

        if ($route = ArrayHelper::getValue($urlString, $this->routes)) {
            return $route;
        }

        foreach ($this->routes as $path => $route) {
            $pattern = '/^' . str_replace('/', '\\/', $path) . '$/';
            if (preg_match_all($pattern, $urlString, $params, PREG_SET_ORDER)) {
                $params = $params[0];
                array_shift($params);
                $this->params = $params;
                return $route;
            }
        }

        throw new RouteException('Not Found. Wrong route', 404);
    }

    /**
     * @return string
     */
    public function getControllerClass()
    {
        return $this->controllerClass;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}
