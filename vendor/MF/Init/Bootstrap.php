<?php

namespace MF\Init;

abstract class Bootstrap
{
    // Atributos
    private $routes;

    //Metodos
    public function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    abstract protected function initRoutes();

    public function getRoutes()
    {
        return $this->routes;
    }
    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }
    public function run($url)
    {
        foreach ($this->getRoutes() as $key => $route) {
            if ($url == $route['route']) {
                $class = "App\\Controllers\\" . ucfirst($route['controller']);
                $action = $route['action'];
                $controller = new $class;
                $controller->$action();
            }
        }
    }

    public function getUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}
