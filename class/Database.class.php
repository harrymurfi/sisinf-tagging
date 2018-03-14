<?php 
class Database
{
  private $connection;
  private $result;

  private function __construct($host, $user, $pwd, $db)
  {
    $this->connection = new mysqli($host, $user, $pwd, $db);
  }

  public static function Open($host="localhost:3306", $user="root", $pwd="", $db="traviandb")
  {
    return new self($host, $user, $pwd, $db);
  }

  public function Query($str)
  {
    return $this->connection->query($str);
  }

  public function Query2($str, ...$params)
  {
    $stmt = $this->connection->prepare;
  }

  public function QuerySingle()
  {

  }

  public function QueryValue()
  {

  }

  public function test($str, ...$params)
  {

  }
}
?>