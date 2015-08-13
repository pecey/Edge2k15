<?php

require 'lib/database.php';
require 'lib/misc.php';
require 'lib/authentication.php';

redirect_if_not_logged_in("login.php");

$updates = get_update();

if(isset($_POST['updates'])){
	if(!isset($_FILES['pdf']) || !file_exists($_FILES['pdf']['tmp_name']) || !is_uploaded_file($_FILES['pdf']['tmp_name'])) {
	    update_updates(stripslashes($_POST['description']));
	  }
	 else{
	 	$info = pathinfo($_FILES['pdf']['name']);
	    $ext = $info['extension']; // get the extension of the file
	    $newname = "updates.".$ext; 

	    $target = 'pdfs/'.$newname;
	    move_uploaded_file( $_FILES['pdf']['tmp_name'], $target);

	    update_updates(stripslashes($_POST['description']), $target);
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
            <li><a href="<?= C_BASEURL ?>events.php">Events</a></li>
            <li><a href="<?= C_BASEURL ?>contacts.php">Contacts</a></li>
            <li  class="active"><a href="<?= C_BASEURL ?>updates.php">Updates</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="panel-template">
        <form action="updates.php" method="post" enctype="multipart/form-data">
          <h4>Short Description</h4>
          <textarea name="description" class="form-control" rows="12"><?= $updates['description'] ?></textarea><br><br>

          <h4>PDF file</h4>
          <input type="file" id="pdf" name="pdf"><br>
           <?php if(isset($updates['file'])): ?>
          A pdf file has been uploaded previously <a href="<?= C_BASEURL.$updates['file']?>">here</a>
          <?php endif; ?>
          <br>
          <input type="hidden" name="updates" value="1">
          <button type="submit" class="btn btn-success">Update Information</button>&nbsp;&nbsp;
          <a href="events.php" class="btn btn-danger">Cancel</a>
        </form>
      </div>

    </div><!-- /.container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html020 49072625
manojg@dsij.in