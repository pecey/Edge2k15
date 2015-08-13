<?php

require 'lib/database.php';
require 'lib/misc.php';
require 'lib/authentication.php';

redirect_if_not_logged_in("login.php");


if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $contact = get_contact($_GET['id']);
}

else if(isset($_POST['id'])) {
  $id = $_POST['id'];
  update_contact($_POST['id'], $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['facebook']);
  $contact = get_contact($_POST['id']);
}

else {
  redirect('contacts.php');
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
            <li class="active"><a href="<?= C_BASEURL ?>contacts.php">Contacts</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="panel-template">
        <h1><?= $contact['name'] ?></h1><br>

        <form action="contact.php" method="post" enctype="multipart/form-data">
          <h4>Name <span style="color: red;">*</span></h4>
          <input type="text" name="name" class="form-control" value="<?= $contact['name'] ?>" required><br><br>

          <h4>E-mail address <span style="color: red;">*</span></h4>
          <input type="email" name="email" class="form-control" value="<?= $contact['email'] ?>" required><br><br>

          <h4>Phone number</h4>
          <input type="text" name="phone" class="form-control" value="<?= $contact['phone'] ?>"><br><br>

          <h4>Facebook Username</h4>
          <input type="text" name="facebook" class="form-control" value="<?= $contact['facebook'] ?>"><br><br><br>

          <input type="hidden" name="id" value="<?= $contact['id'] ?>">

          <button type="submit" class="btn btn-success">Update Information</button>&nbsp;&nbsp;
          <a href="contacts.php" class="btn btn-danger">Cancel</a>
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