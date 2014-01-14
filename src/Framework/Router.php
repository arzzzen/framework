<?php
  namespace Framework;
  use Framework\Pattern\Singleton as Singleton;

  class Router extends Singleton
  {
    private $controller = 'Main';
    private $action     = 'index';
    protected $routes;
    public $matches = [];

    public function getControllerClass()
    {
      return "\\controller\\{$this->controller}Controller";
    }

    public function getAction()
    {
      return "{$this->action}Action";
    }

    public function initialize()
    {
      require_once('config/routing.php');
      foreach ($this->routes as $route) {
        if (preg_match($route['path'], Request::getInstance()->path, $matches)) {
          $this->controller = $route['controller'];
          $this->action = $route['action'];
          if (!empty($matches))
            $this->matches = $matches;
        }
      }
    }
  }
?>