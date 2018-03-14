<?php 
  class Village
  {
    public $vid;
    public $player_id;
    public $tile_id;
    public $name;
    public $resources;
    public $new_resources;
    public $warehouse_cap;
    public $granary_cap;
    public $rate;
    public $last_modified;
    public $timediff;
    public $resource_fields;

    public function __construct($vid)
    {
      $db = new MyDB();

      // set village data
      $res = $db->Query("select * from village where vid={$vid}");
      $row = $res->fetch_assoc();
      $this->vid = $row['vid'];
      $this->player_id = $row['player_id'];
      $this->tile_id = $row['tile_id'];
      $this->name = $row['name'];
      $this->resources = array('wood' => $row['wood'], 'clay' => $row['clay'], 'iron' => $row['iron'], 'wheat' => $row['wheat']);
      $this->warehouse_cap = $row['warehouse_cap'];
      $this->granary_cap = $row['granary_cap'];
      $this->rate = array('wood' => $row['wood_rate'], 'clay' => $row['clay_rate'], 'iron' => $row['iron_rate'], 'wheat' => $row['wheat_rate']);
      $this->last_modified = $row['last_modified'];

      // get time diff since last update
      try
      {
        $db->Execute("set @diff = timediff(current_timestamp, '$this->last_modified')");
        $res = $db->Query("select time_to_sec(@diff)");
        $this->timediff = $res->fetch_row()[0];
        //var_dump($this->timediff);
      }
      catch(\Exception $e)
      {
        $e->getMessage();
        $db->Rollback();
      }

      // refresh village data
      try
      {
        foreach($this->resources as $key => $value)
        {
          $this->new_resources[$key] = $value + ($this->rate[$key] * $this->timediff / 3600);
        }
        /*
        echo'<br>';
        var_dump($this->timediff);
        echo'<br>';
        var_dump($this->rate);
        echo'<br>';
        var_dump($this->resources);
        echo'<br>';
        var_dump($this->new_resources);*/

        $str = "update village set wood={$this->new_resources['wood']}, clay={$this->new_resources['clay']}, iron={$this->new_resources['iron']}, wheat={$this->new_resources['wheat']}
          where vid=$this->vid";
        $db->Query($str);
        $db->Commit();

      }
      catch(Exception $e)
      {
        $e->getMessage();
        $db->Rollback();
      }

      // set resource fields
      $res = $db->Query("select distinct slot_num, id from building where village_id={$this->vid}");
      while($row = $res->fetch_assoc())
      {
        $this->resource_fields[$row['slot_num']] = $row['id'];
      }
      /*
      foreach($this->resource_fields as $key => $val) 
      {
        echo "slot = " . $key . ", id reso = " . $val;
        echo "<br>";
      }*/
    }

    public function village_refresh_update($db, $vid)
    {
      try
      {
        $res = $db->Query("select wood, clay, iron, wheat, last_modified from village where vid={$vid}");
        if($row = fetch_assoc())
        {
          
        }
        foreach($this->resources as $key => $value)
        {
          $new_resources[$key] = $value + ($this->rate[$key] * $this->timediff / 3600);
        }
        $str = "update village 
          set wood={$new_resources['wood']}, clay={$new_resources['clay']}, 
          iron={$new_resources['iron']}, wheat={$new_resources['wheat']} 
          where vid=$vid";
        $db->Query($str);
        $db->Commit();
      }
      catch(Exception $e)
      {
        $e->getMessage();
        $db->Rollback();
      }
    }
  }
?>