<?php
  namespace Framework;
  
  class App
  {
    private $router;
    private $controller;
    private $settings = [];

    public function __construct()
    {
      $this->router = new Router();
      $controller_class = $this->router->getControllerClass();
      $this->controller = new $controller_class();
    }

    public function getSettings(string $key)
    {
      return $this->settings[$key];
    }

    public function run()
    {
      session_start();
      $action = $this->router->getAction();
      $output = (method_exists($this->controller, $action)) ?
        $this->controller->{$action}() : '404 not found';
      echo $output;
    }
  }
?>