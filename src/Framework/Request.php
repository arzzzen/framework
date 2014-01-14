<?php
  namespace Framework;
  use Framework\pattern\Singleton as Singleton;

  class Request extends Singleton{

    protected $get = [];
    protected $method;
    protected $path;

    protected function initialize()
    {
      $this->getRequestParams();
    }

    public function getParam($key)
    {
      return (isset($this->get[$key])) ? $this->get[$key] : null;
    }

    public function __get($key) {
      if (isset($this->$key))
        return $this->$key;
      else 
        throw new \Exception("There is no property $key in Request");
    }

    private function getRequestParams()
    {
      $request_array = [];
      $this->method = $_SERVER['REQUEST_METHOD'];
      $this->path = parse_url($_SERVER['REQUEST_URI'])['path'];
      $this->method === 'GET' ? $request_array = $_GET : $request_array = $_POST;
      foreach ($request_array as $key => $value){
        if ($value !== '') $this->get[$key] = $value;
      }
    }
  }
?>