<?php
  namespace Framework\Debug;

  use Framework\Request as Request;
  use Framework\Router as Router;

  class Debugger
  {
    protected static $list = array();

    public static function Run()
    {
      self::$list['method'] = Request::getInstance()->method;
      self::$list['path'] = Request::getInstance()->path;
      self::$list['controller'] = str_replace('\\controller\\', '', Router::getInstance()->getControllerClass());
      self::$list['action'] = Router::getInstance()->getAction();
      require __DIR__.'/src/view.php';
    }
  }