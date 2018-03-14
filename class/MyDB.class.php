<?php 
  class MyDB
  {
    private $connection;
    public function __construct()
    {
      $this->connection = new mysqli('localhost:3306', 'root', '', 'traviandb');
      $this->connection->autocommit(false);
    }

    public function Query($str)
    {
      if($res = $this->connection->query($str))
        return $res;
      else
        throw new Exception("Query statement failed.", 1);
      //if(is_object($res) && $res->num_rows == 0)
      //  throw new Exception("Query zero.", 1);
    }

    public function Execute($str)
    {
      if($this->connection->query($str))
        return true;
      else
        throw new Exception("Execute statement failed.", 1);
    }

    public function QueryStatement($str, ...$params)
    {

    }

    public function Commit()
    {
      $this->connection->commit();
    }

    public function Rollback()
    {
      $this->connection->rollback();
    }

    public function Close()
    {
      $this->connection->close();
    }
  }
?>