<?php
  namespace Framework;

  use Framework\pattern\IDataMapper as IDataMapper;

  abstract class Repository implements IDataMapper
  {

    private $model_name;

    public function __construct() {
      $this->model_name = str_replace('Repository', '', get_called_class());
      if (!isset($this->table_name))
      {
        $this->table_name = $thsi->model_name;
      }
    }

    public function find($id) {
      $sth = DBManager::getInstance()->getDBH()->prepare(
        'SELECT * FROM '.$this->table_name.' WHERE id=:id'
      );
      $sth->bindParam(':id', $id);
      $sth->setFetchMode(\PDO::FETCH_INTO, new $this->model_name());
      $sth->execute();
      
      return $sth->fetch();
    }
  }
?>