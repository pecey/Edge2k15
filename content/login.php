<?php

require 'lib/database.php';
require 'lib/misc.php';
require 'lib/authentication.php';

redirect_if_logged_in("events.php");

$invalid = false;

if(isset($_POST['username'])) {
  if(authenticate($_POST['username'], $_POST['password'])) {
    login();
    redirect("events.php");
  }
  else {
    $invalid = true;
  }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edge CMS</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?= C_BASEURL ?>">Edge CMS</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?= C_BASEURL ?>login.php">Log in</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <h1>Welcome</h1><br>
        <p class="lead">Welcome to the Edge Content Management System.<br>Use your credentials to log in.</p><br>

        <form style="width: 300px; margin: 0 auto;" action="login.php" method="post">

          <?php if($invalid === true): ?>
          <div class="alert alert-danger" role="alert">Invalid credentials!</div>
          <?php endif; ?>

          <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username">
          </div>
          
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>

          <br>

          <button type="submit" class="btn btn-default">Log in to the Panel</button>
        </form>
      </div>

    </div><!-- /.container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>