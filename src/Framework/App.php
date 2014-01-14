<?php
  namespace Framework;
  use Framework\Debug\Debugger as Debugger;
  
  class App
  {
    private $router;
    private $controller;

    public function __construct()
    {
      $this->router = Router::getInstance();
      $controller_class = $this->router->getControllerClass();
      $this->controller = new $controller_class();
    }

    public function run($debug = 'not debug')
    {
      session_start();
      $action = $this->router->getAction();
      if (method_exists($this->controller, $action)) {
        if (isset($this->router->matches[1])) {
          $output = $this->controller->{$action}($this->router->matches[1]);
        } else {
          $output = $this->controller->{$action}();
        }
      } else {
        '404 not found';
      }
      echo $output;
      if ($debug === 'debug')
        Debugger::run();
    }
  }
?>