<?php
  namespace Framework;
  
  abstract class Controller
  {
    public function __construct() {}

    public function render($tpl, $val_arr = array())
    {
      $loader = new \Twig_Loader_Filesystem('app/templates');
      $twig = new \Twig_Environment($loader);
      $controller_class = basename(get_called_class());
      $output = $twig->render("$controller_class/$tpl", $val_arr);
      return $output;
    }

    public function getRepository($repository)
    {
      $repository = '\\models\\'.$repository.'Repository';
      return call_user_func($repository .'::getInstance');
    }
  }
?>