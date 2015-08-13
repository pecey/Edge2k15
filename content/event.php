<?php

require 'lib/database.php';
require 'lib/misc.php';
require 'lib/authentication.php';

redirect_if_not_logged_in("login.php");


$contacts = get_all_contacts();

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $event = get_event($_GET['id']);
}

else if(isset($_POST['id'])) {

  if(!isset($_FILES['pdf']) || !file_exists($_FILES['pdf']['tmp_name']) || !is_uploaded_file($_FILES['pdf']['tmp_name'])) {
    update_event($_POST['id'], stripslashes($_POST['description']));
  }

  else {
    $info = pathinfo($_FILES['pdf']['name']);
    $ext = $info['extension']; // get the extension of the file
    $newname = $_POST['id'].".".$ext; 

    $target = 'pdfs/'.$newname;
    move_uploaded_file( $_FILES['pdf']['tmp_name'], $target);

    update_event($_POST['id'], stripslashes($_POST['description']), $target);
  }

  $id = $_POST['id'];
  $contact_id1 = $_POST['contact_id1'];
  $contact_id2 = $_POST['contact_id2'];

  if($contact_id1 == -1)
    $contact_id1 = false;

  if($contact_id2 == -1)
    $contact_id2 = false;

  set_event_contacts($id, $contact_id1, $contact_id2);

  $event = get_event($_POST['id']);

}

else {
  redirect('events.php');
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
            <li class="active"><a href="<?= C_BASEURL ?>events.php">Events</a></li>
            <li><a href="<?= C_BASEURL ?>contacts.php">Contacts</a></li>
            <li><a href="<?= C_BASEURL ?>updates.php">Updates</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="panel-template">
        <h1><?= $event['name'] ?></h1><br>

        <form action="event.php" method="post" enctype="multipart/form-data">
          <h4>Short Description</h4>
          <textarea name="description" class="form-control" rows="12"><?= $event['description'] ?></textarea><br><br>

          <h4>PDF file</h4>
          <input type="file" id="pdf" name="pdf"><br>
          <?php if(isset($event['file'])): ?>
          A pdf file has been uploaded previously <a href="<?= C_BASEURL.$event['file']?>">here</a>
          <?php endif; ?>
          <br>


          <h4>Contact 1</h4>
          <select name="contact_id1">
            <option value="-1">None</option>
            <?php foreach($contacts as $contact): ?>
            <?php if($event['contact_id1'] == $contact['id']): ?>
            <option value="<?= $contact['id'] ?>" selected><?= $contact['name'] ?></option>
            <?php else: ?>
            <option value="<?= $contact['id'] ?>"><?= $contact['name'] ?></option>
            <?php endif; ?>
            <?php endforeach; ?>
          </select><br><br>

          <h4>Contact 2</h4>
          <select name="contact_id2">
            <option value="-1">None</option>
            <?php foreach($contacts as $contact): ?>
            <?php if($event['contact_id2'] == $contact['id']): ?>
            <option value="<?= $contact['id'] ?>" selected><?= $contact['name'] ?></option>
            <?php else: ?>
            <option value="<?= $contact['id'] ?>"><?= $contact['name'] ?></option>
            <?php endif; ?>
            <?php endforeach; ?>
          </select><br><br><br>

          <input type="hidden" name="id" value="<?= $event['id'] ?>">

          <button type="submit" class="btn btn-success">Update Information</button>&nbsp;&nbsp;
          <a href="events.php" class="btn btn-danger">Cancel</a>
        </form>
      </div>

    </div><!-- /.container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <script>
      function filter_by_category($category_id) {
        $('tbody tr').hide();
        $('tr[data-category-id=' + $category_id + ']').show();
      }
    </script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>