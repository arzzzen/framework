<?php
  namespace Framework;
  use Framework\pattern\Singleton as Singleton;

  class Request extends Singleton{

    protected $get = [];

    protected function initialize()
    {
      $this->getRequestParams();
      $this->getControllerAndAction();
    }

    public function getParam($key)
    {
      if (isset($this->get[$key]))
        return $this->get[$key];
      else 
        return null;
    }

    private function getRequestParams()
    {
      $request_array = [];
      $_SERVER['REQUEST_METHOD'] = 'GET' ? $request_array = $_GET : $request_array = $_POST;
      foreach ($request_array as $key => $value){
        if ($value !== '') $this->get[$key] = $value;
      }
    }

    private function getControllerAndAction() {
      $this->get['path'] = parse_url($_SERVER['REQUEST_URI'])['path'];
    }
  }
?>