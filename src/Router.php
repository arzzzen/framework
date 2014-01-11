<?php
  namespace Framework;

  class Router
  {
    private $controller = 'Main';
    private $action     = 'index';
    protected $routes;

    public function getControllerClass()
    {
      foreach ($this->routes as $route) {
        if (Request::getInstance()->getParam('path') === $route['path'])
          $this->controller = $route['controller'];
      }
      return 'controller\\'.$this->controller.'Controller';
    }

    public function getAction()
    {
      foreach ($this->routes as $route) {
        if (Request::getInstance()->getParam('path') === $route['path'])
          $this->action = $route['action'];
      }
      return $this->action.'Action';
    }

    public function __construct()
    {
      require_once('Framework/config/routing.php');
    }
  }
?>