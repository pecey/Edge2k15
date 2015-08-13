<?php
require_once('Database.php');

if(isset($_POST["action"])){
	if($_POST["action"]=="add"){
		Ambassador::add();
	}
}

class Ambassador{

	public $data;

	public static function exists($id){
		$result = Database::query("SELECT * FROM `campus_ambassadors` WHERE `id`=?",$id);
		if(count($result)==0)
			return false;
		else
			return true;
	}


	public static function add(){

		$errors = array();

		if(!isset($_POST['name'])||empty($_POST['name'])){
			$errors["statusCode"]=0;
			$errors["username"]= "Name not entered";
		}

		if(!isset($_POST['email'])||empty($_POST['email'])){
			$errors["statusCode"]=0;
			$errors["email"]="Email not entered";
		}

		if(!isset($_POST['college'])||empty($_POST['college'])){
			$errors["statusCode"]=0;
			$errors["college"]= "College not entered";
		}
		if(!isset($_POST['contact'])||empty($_POST['contact'])){
			$errors["statusCode"]=0;
			$errors["contact"]= "Contact not entered";
		}
		if(!isset($_POST['department'])||empty($_POST['department'])){
			$errors["statusCode"]=0;
			$errors["department"]= "Department not entered";
		}
		$name = $_POST['name'];
		$college = $_POST['college'];
		$email = $_POST['email'];
		$year = $_POST['year'];
		$department = $_POST['department'];
		$contact = $_POST['contact'];

		if(empty($errors)){

			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				$table_name='campus_ambassadors';
				$data=array('name'=>$name,'email'=>$email,'college'=>$college, 'year'=>$year, 'department'=>$department, 'contact'=>$contact, 'line_hits'=>0);
				$result=Database::insert($table_name, $data);
				$errors["statusCode"]=1;
				print_r(json_encode($errors));
				return;
                    #print_r(json_encode($result));
                    #return;
			}
			else{
				$errors["statusCode"]=0;
				$errors["already"]= "The email id you provided is already registered with us";
			}
		}
		else{
			$errors["statusCode"]=0;
			$errors["valid"]="That isn't a valid email";
		}
	
	echo(json_encode($errors));
}
public static function download($id, $hits){
	$result = Database::update("UPDATE `campus_ambassadors` SET `line_hits`=? WHERE `id`=?", $hits, $id);
}

public static function getDetailsById($id){
	$result=Database::query("SELECT * FROM `campus_ambassadors` WHERE `id`=?",$id);
	return $result[0];
}

public static function getAllDetails(){
	$result=Database::query("SELECT * FROM `campus_ambassadors` WHERE `id`!=?",0);
	return $result;
}
public static function countAll(){
	$result=Database::query("SELECT COUNT(*) as `COUNT` FROM `campus_ambassadors` WHERE `id`!=?",0);
	return $result[0]['COUNT'];
}


}


?>