<?php


namespace app\sys;

class View
{
    /**
     * @var string
     */
    private $basePath;

    public function __construct()
    {
        $this->setBasePath(__DIR__ . '/../views');
    }

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     */
    public function setBasePath(string $basePath)
    {
        $this->basePath = $basePath;
    }

    public function render($view, $params = [])
    {
        if (is_array($params)) {
            extract($params, EXTR_OVERWRITE);
        }
        ob_start();

        include $this->getBasePath() . DIRECTORY_SEPARATOR . $view . '.php';

        return ob_get_clean();
    }
}
