<?php
	require_once('Database.php');

	class User{

		public static $data;
		public static function login($email, $password){
			if(isset($email) && isset($password))
			{
				$results=Database::query("SELECT * FROM `admin` WHERE `email`=? and `password`=?",$email, md5($password));
				if(count($results))
				{
					$_SESSION['data']=$results[0];
					return $results[0];
				}
				else{
					return false;
				}

			}
			else{
				return false;
			}
		}

		public static function is_logged(){
			return isset($_SESSION['data']);
		}
	}

?>