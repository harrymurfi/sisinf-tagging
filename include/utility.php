<?php
  require_once('my_autoloader.php');

  function registering_player($username, $password)
  {
    try
    {
      $db = new MyDB();
      if(checking_id($db, $username))
      {
        if(create_id($db, $username, $password))
        {
          if(create_village($db, $username))
          {
            $db->Commit();
            return true;
          }
        }
      }
      else
      {
        $db->Rollback();
        return false;
      }
    }
    catch(Exception $e)
    {
      $db->Rollback();
      echo $e->getMessage();
      return false;
    }
  }

  function checking_id($db, $username)
  {
    $res = $db->Query("select count(pid) from player where username='{$username}'");
    if($res->fetch_row()[0] == 0)
      return true;
    else
      return false;
  }

  function create_id($db, $username, $password)
  {
    if($db->Execute("insert into player values(null, '{$username}', '{$password}')"))
      return true;
    else
      return false;
  }

  function create_village($db, $username)
  {
    $tile_id = get_tile($db);
    if($tile_id)
    {
      $res = $db->Query("select pid from player where username='{$username}' limit 1");
      $pid = $res->fetch_row()[0];
      $db->Execute("insert into village(player_id, tile_id, name, capital, wood, clay, iron, wheat) values({$pid}, {$tile_id}, 'New Village', 1, 800, 800, 800, 800)");
      $db->Execute("update tile set occupied=1 where tid={$tile_id}");
      return true;
    }
    return false;
  }

  function get_tile($db)
  {
    $res = $db->Query("select tid from tile where occupied=0");
    if($res && $res->num_rows != 0)
    {
      $rand = mt_rand(0, $res->num_rows - 1);
      $res->data_seek($rand);
      return $res->fetch_row()[0];
    }
    return false;
  }

  function create_resources($db, $vid)
  {
    $str = "insert into resources(village_id, slot_num, type) values
      ({$vid}, 1, 1), ({$vid}, 2, 1), ({$vid}, 3, 1), ({$vid}, 4, 1),
      ({$vid}, 5, 2), ({$vid}, 6, 2), ({$vid}, 7, 2), ({$vid}, 8, 2),
      ({$vid}, 9, 3), ({$vid}, 10, 3), ({$vid}, 11, 3), ({$vid}, 12, 3),
      ({$vid}, 13, 4), ({$vid}, 14, 4), ({$vid}, 15, 4), ({$vid}, 16, 4), ({$vid}, 17, 4), ({$vid}, 18, 4)";
    if($db->Execute($str)) return true;
    else return false;
  }
?>