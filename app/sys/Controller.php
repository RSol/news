<?php


namespace app\sys;


class Controller
{
    /**
     * @var array
     */
    protected $params;

    /**
     * @var App
     */
    protected $app;

    /**
     * @var string
     */
    public $layout = 'main';

    public function __construct(App $app, array $params)
    {
        $this->app = $app;
        $this->params = $params;
    }

    /**
     * @return View
     */
    public function getView()
    {
        return new View();
    }

    /**
     * @param $view
     * @param array $params
     * @return false|string
     */
    public function render($view, $params = [])
    {
        $viewInstance = $this->getView();
        $content = $viewInstance->render($view, $params);
        if ($this->layout) {
            $layout = "layouts/{$this->layout}";
            $content = $viewInstance->render($layout, [
                'content' => $content,
            ]);
        }
        return $content;
    }

    /**
     * @param $data
     */
    public function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    /**
     * @param $url
     */
    public function redirect($url)
    {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: {$url}");
        exit();
    }
}
