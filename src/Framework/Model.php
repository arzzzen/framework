<?php
  namespace Framework;

  abstract class Model
  {
    public function __construct(){}

    public function save()
    {
      $this->getRepository()->save($this);
    }

    private function getRepository()
    {
      $repository_class = get_called_class().'Repository';
      return $repository_class::getInstance();
    }
  }
?>