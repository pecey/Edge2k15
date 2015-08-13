<?php

/*******************************************
 * Put auth config in here
 *******************************************/

define("C_AUTHUSER", 'admin');
define("C_AUTHPASS", 'edge2015admin');


/*******************************************
 * Begin auth library functions
 *******************************************/

session_start();

function is_logged_in() {
	return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
}

function authenticate($user, $pass) {
	return $user == C_AUTHUSER && $pass == C_AUTHPASS;
}

function login() {
	$_SESSION['auth'] = true;
}

function logout() {
	session_destroy();
}

function redirect_if_not_logged_in($path) {
	if(!is_logged_in()) {
		header('Location: ' . C_BASEURL . $path);
		exit();
	}
}

function redirect_if_logged_in($path) {
	if(is_logged_in()) {
		header('Location: ' . C_BASEURL . $path);
		exit();
	}
}

function redirect($path) {
	header('Location: ' . C_BASEURL . $path);
}

