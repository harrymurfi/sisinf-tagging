<?php
  require_once('my_autoloader.php');
  $status = "";
  if(isset($_POST['username']))
  {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $mysqli = get_db();
    if($stmt = $mysqli->prepare("select username from admin where username=? and password=?"))
    {
      $stmt->bind_param("ss", $username, $password);
      $stmt->execute();
      $stmt->bind_result($found_user);
      if($stmt->fetch())
      {
        set_session($found_user);
        $stmt->close();
        $mysqli->close();
        header('location: index.php');
        die();
      }
      else
      {
        $status = "Username atau password salah!";
      }
      $stmt->close();
    }
    $mysqli->close();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
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
  </nav>
</div>
  
<div class="container" style="margin-top:62px">
  <form class="form" method="post">
    <div class="form-group" style="margin-bottom: 3px">
      <input type="text" class="form-control form-control-sm col-sm-4" placeholder="Username..." name="username" maxlength="50" required>
    </div>
    <div class="form-group" style="margin-bottom: 3px">
      <input type="text" class="form-control form-control-sm col-sm-4" placeholder="Password..." name="password" maxlength="50" required>
    </div>
    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
    <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
  </form>
  <p class="status"><?=$status;?></p>
</div>

</body>
</html>