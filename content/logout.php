<?php

require 'lib/database.php';
require 'lib/misc.php';
require 'lib/authentication.php';

redirect_if_not_logged_in("login.php");
logout();
redirect("login.php");

