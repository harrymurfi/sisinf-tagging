<?php 
  session_start();

  function session_check()
  {
    if(!isset($_SESSION['pid']))
    {
      header('location: login.php');
      die();
    }
  }

  function set_current_village($pid)
  {
    $db = new MyDB();
    $res = $db->Query("select vid from village where player_id={$pid} and capital=1 limit 1");
    $vid = $res->fetch_assoc()['vid'];
    $_SESSION['current_village'] = $vid;
  }

  function set_session($pid, $username)
  {
    $_SESSION['pid'] = $pid;
    $_SESSION['username'] = $username;
  }
?>