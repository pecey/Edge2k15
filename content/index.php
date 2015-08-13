<?php

require 'lib/database.php';
require 'lib/misc.php';
require 'lib/authentication.php';

redirect_if_logged_in("events.php");
redirect("login.php");

