<?php
  namespace Framework;

  use Framework\Pattern\Singleton as Singleton;

  class DBManager extends Singleton
  {

    protected $dbh;

    protected function initialize()
    {
      require_once('config/database.php');
      try {
          $this->dbh = new \PDO('mysql:host='.$settings['dbhost'].';dbname='.$settings['dbname'].';charset=UTF8',
           $settings['dbuser'], $settings['dbpass']);
      } catch (\PDOException $e) {
          die("Error DB connection!: " . $e->getMessage());
      }
    }

    public function getDBH()
    {
      return $this->dbh;
    }
  }
?>