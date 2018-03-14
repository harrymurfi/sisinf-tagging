<?php 
  class player
  {
    private $player_id;
    private $username;
    private $email;
    private $password;
    private $reg_date;
    private $villages;

    function __construct($player_id, $username, $email, $password, $reg_date)
    {
      $this->player_id = $player_id;
      $this->username = $username;
      $this->email = $email;
      $this->password = $password;
      $this->reg_date = $reg_date;
    }

    public static function create($id)
    {
      $mysqli = new mysqli("localhost:3306", "root", "", "travian");
      if($result = $mysqli->query("select * from player where player_id = {$id} limit 1"))
      {
        if($result->num_rows == 0)
        {
          echo "error: no player found.";
          return null;
        } 
        else
        {
          $row = $result->fetch_assoc();
          return new self($row['player_id'], $row['username'], $row['email'], $row['password'], $row['reg_date']);
        }
      }
      else
      {
        echo "error: couldn't perform operation.";
        return null;
      }
    }

    public function getId()
    {
      return $this->player_id;
    }

    public function display()
    {
      echo 'Player';
      echo '<br>Id: ' . $this->player_id;
      echo '<br>Username: ' . $this->username;
      echo '<br>Email: ' . $this->email;
      echo '<br>Password: ' . $this->password;
      echo '<br>Reg date: ' . $this->reg_date;
    }
  }
?>