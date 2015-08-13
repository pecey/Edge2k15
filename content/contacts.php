<?php

require 'lib/database.php';
require 'lib/misc.php';
require 'lib/authentication.php';

redirect_if_not_logged_in("login.php");


$contacts = get_all_contacts();

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
            <li><a href="<?= C_BASEURL ?>updates.php">Updates</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="panel-template">
        <a href="new_contact.php" class="btn btn-default">Create new contact</a>

        <br><br><br>

        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <td>#</td>
              <td>Name</td>
              <td>E-mail</td>
            </tr>
          </thead>

          <tbody>
            <?php foreach($contacts as $contact): ?>

            <tr data-id="<?= $contact['id'] ?>">
              <td><?= $contact['id'] ?></td>
              <td><a href="contact.php?id=<?= $contact['id'] ?>"><?= $contact['name'] ?></a></td>
              <td><a href="mailto:<?= $contact['email'] ?>"><?= $contact['email'] ?></a></td>
            </tr>
            
            <?php endforeach; ?>
          </tbody>
        </table>
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