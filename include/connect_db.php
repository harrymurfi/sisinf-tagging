<?php 
  const DB_HOST = "localhost:3306";
  const DB_USER = "root";
  const DB_PWD = "";
  const DB_NAME = "kalbedb";

  function get_db()
  {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME);
    if($mysqli->connect_error)
    {
      echo 'Failed to connect. Please try again later.';
      die();
    }
    return $mysqli;
  }
?>