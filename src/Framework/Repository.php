<?php
  namespace Framework;

  use Framework\pattern\IDataMapper as IDataMapper;
  use Framework\pattern\Singleton as Singleton;

  abstract class Repository extends Singleton implements IDataMapper
  {
    private $model_name;
    private $table_name;
    private $DBH;

    public function initialize()
    {
      $this->model_name = str_replace('Repository', '', get_called_class());
      if (!isset($this->table_name))
      {
        $this->table_name = basename($this->model_name);
      }
      $this->DBH = DBManager::getInstance()->getDBH();
    }

    public function find($id)
    {
      $sth = $this->DBH->prepare(
        'SELECT * FROM '.$this->table_name.' WHERE id=:id'
      );
      $sth->bindParam(':id', $id);
      $sth->setFetchMode(\PDO::FETCH_INTO, new $this->model_name);
      if (!$sth->execute()) {
        throw new \Exception("Can't get model {$this->model_name} from table {$this->table_name} where id=$id");
      }
      return $sth->fetch();
    }

    public function findAll()
    {
      $sth = $this->DBH->prepare(
        'SELECT * FROM '.$this->table_name
      );
      if (!$sth->execute()) {
        throw new \Exception("Can't get model {$this->model_name} from table {$this->table_name} where id=$id");
      }
      return $sth->fetchAll(\PDO::FETCH_CLASS, $this->model_name);
    }

    public function save($models)
    {
      if (is_array($models)) {
        foreach ($models as $model) {
          $this->saveOne($model);
        }
      } else {
        $this->saveOne($models);
      }
    }

    private function saveOne(Model $model)
    {
      if (isset($model->id)) {
        $set = 'title = :title, content = :content';
        $sth = $this->DBH->prepare(
          "UPDATE $this->table_name SET $set WHERE id=:id"
        );
        $sth->bindParam(':id', $model->id);
      } else {
        $keys = 'title, content';
        $values = ':title, :content';
        $sth = $this->DBH->prepare(
          "INSERT INTO $this->table_name ($keys) VALUES ($values)"
        );
      }
      $sth->bindParam(':title', $model->title);
      $sth->bindParam(':content', $model->content);
      if (!$sth->execute()) {
        throw new \Exception("Can't update model {$this->model_name} in table {$this->table_name} where id=$id");
      }
    }
  }
?>