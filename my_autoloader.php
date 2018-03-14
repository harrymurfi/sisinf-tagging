<?php 
  spl_autoload_register('myAutoloader');
  require_once('include/connect_db.php');
  require_once('include/session.php');
  require_once('include/utility.php');

  function myAutoloader($className)
  {
      require_once('class/'.$className.'.class.php');
  }