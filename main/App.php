<?php

namespace app\main;


use app\traits\SingletonTrait;

class App
{
    use SingletonTrait;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @return self
     */
    public static function call()
    {
        return static::getInstance();
    }

    public function run($config)
    {
        $this->container = new Container($config['components']);
        $this->config = $config;
        $this->runController();
    }

    private function runController()
    {
        $request = new \app\services\Request();
        $controllerName = $this->config['defaultController'];
        if (!empty($request->getActionName())) {
            $controllerName = $request->getControllerName();
        }

        $controllerClass = 'app\\controllers\\' . ucfirst($controllerName) . 'Controller';

        if (class_exists($controllerClass)) {
            $renderer = new \app\services\TwigRenderServices();
            /** @var \app\controllers\Controller $controller */
            $controller = new $controllerClass($request, $this->container);
            echo $controller->run($request->getActionName());
        } else {
            echo '404';
        }
    }
}