<?php 
  class Player
  {
    public $pid;
    public $username;
    private $password;

    function __construct($row)
    {
      $this->pid = $row['pid'];
      $this->username = $row['username'];
      $this->password = $row['password'];
    }
  }
?>