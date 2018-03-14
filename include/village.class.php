<?php 
  class village
  {
    private $village_id;
    private $owner;
    private $name;
    private $coord;
    private $population;
    private $tile;
    public $resources;
    private $res_rate;
    private $last_modified;
    private $timespan;
    private $building_slots;
    private $keep_capacity;
    private $troops;
    private $troop_movements;

    private function __construct($row)
    {
      $this->village_id = $row['id'];
      $this->resources = array('wood' => $row['wood'], 
                              'clay' => $row['clay'], 
                              'iron' => $row['iron'], 
                              'crop' => $row['crop']);
      $this->last_modified = $row['last_modified'];
      $this->timespan = $this->timeDifference($row['last_modified']);
      
    }

    public static function create($id)
    {
      $mysqli = new mysqli('localhost:3306', 'root', '', 'travian');
      $result = $mysqli->query("select id, player_id, wood, clay, iron, crop, 
        UNIX_TIMESTAMP(last_modified) as last_modified
        from village_test where player_id = {$id} limit 1");
      if(!$result || $result->num_rows == 0)
      {
        echo 'error: village not found';
        return null;
      }
      else
      {
        $row = $result->fetch_assoc();
        return new self($row);
        //return new self($row['id'], $row['wood'], $row['clay'], $row['iron'], $row['crop'], $row['last_modified']);
      }
    }

    public function showBefore()
    {
      echo 'Before';
      echo '<br>Last modified: ' . $this->last_modified;
      echo '<br>Time difference: ' . $this->timespan;
      echo '<br>Format seconds: ' . $this->formatSecond($this->timespan);
      echo '<br>Wood: ' . $this->resources['wood'];
      echo '<br>Clay: ' . $this->resources['clay'];
      echo '<br>Iron: ' . $this->resources['iron'];
      echo '<br>Crop: ' . $this->resources['crop'];
    }

    public function showAfter()
    {
      echo '<br>After';
      echo '<br>Wood: ' . floor($this->add('wood'));
      echo '<br>Clay: ' . floor($this->add('clay'));
      echo '<br>Iron: ' . floor($this->add('iron'));
      echo '<br>Crop: ' . floor($this->add('crop'));
    }

    private function add($data)
    {
      $rate = 60; // per hour
      return $this->resources[$data] += ($this->timespan/3600) * $rate;
    }

    private function timeDifference($last_mod)
    {
      $now = time();
      return $now - $last_mod;
    }

    private function formatSecond($t, $f = ':')
    {
      return sprintf("%02d%s%02d%s%02d", floor($t/3600), $f, ($t/60)%60, $f, $t%60);
    }

    private function connectdb()
    {
      return new mysqli('localhost:3306', 'root', '', 'travian');
    }
  }
?>