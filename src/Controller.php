<?php
  namespace Framework;
  
  abstract class Controller {

    public function __construct() {
    }

    // public function __get($value){
    //   die("No $value!");
    // }

    public function render($tpl, $val_arr = null) {
      $controller_class = basename(get_called_class());
      $tpl_content = file_get_contents('./templates/'.$controller_class."/$tpl");
      if (!is_null($val_arr)) {
        foreach($val_arr as $find => $replace) {
          $tpl_content = str_replace("{{$find}}", $replace, $tpl_content);
        }
      }
      return $tpl_content;
    }

    public function getRepository($repository) {
      $repository = '\\models\\'.$repository.'Repository';
      return new $repository(DBManager::getInstance());
    }
  }
?>