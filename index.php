<?php
  require_once('my_autoloader.php');

  session_start();
  if(!isset($_SESSION['username']))
  {
    header('location: login.php'); 
    die();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="lib/css/bootstrap.min.css">
  <script src="lib/js/jquery-3.3.1.slim.min.js"></script>
  <script src="lib/js/popper.min.js"></script>
  <script src="lib/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="lib/css/site.css">
  <script src="lib/js/site.js"></script>
</head>
<body>

<div class="container-fluid">
  <nav class="navbar navbar-expand-sm bg-success navbar-dark fixed-top">
    <a class="navbar-brand" href="#" style="min-width: 83px"></a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <span class="navbar-text"><strong>PT. Kalbe Morinaga Indonesia</strong></span>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <span class="navbar-text">Logged as <strong><?=$_SESSION['username'];?></strong> | </span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </nav>
</div>

<div class="container">

<p>asdasd</p>
</div>
</body>
</html>