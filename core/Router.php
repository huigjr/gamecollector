<?php

class Router
{

    private $di;
    public $controller;

    public function __construct()
    {
        $this->di = new DI();
        $this->di->Session;
        $this->controller = $this->getController($this->parse());
    }

    private function parse()
    {
        if (isset($_GET['path'])) {
            return (substr($_GET['path'], -1) === '/') ? RedirectHelper::pageNotFound() : explode('/', $_GET['path']);
        } else return ['home'];
    }

    private function getController($path)
    {
        if (count($path) === 1) {
            if($path[0] === 'logout') RedirectHelper::logout();
            return $this->startController($path[0]) ?? $this->startController('page', $path) ?? null;
        } else {
            $class = array_shift($path);
            return $this->startController($class, $path);
        }
    }

    private function startController($class, $slug = null)
    {
        $class = ucfirst($class) . 'Controller';
        return class_exists($class) ? new $class($this->di, $slug) : RedirectHelper::pageNotFound();
    }
}