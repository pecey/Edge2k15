<?php

/*******************************************
 * Put database config in here
 *******************************************/

define("C_HOSTNAME", 'localhost');
define("C_USERNAME", 'geekonix_edge15');
define("C_PASSWORD", 'wOx8QapdksQQ');
define("C_DATABASE", 'geekonix_edge15');


/*******************************************
 * Begin database library functions
 *******************************************/

function get_new_connection () {
	$conn = new mysqli(C_HOSTNAME, C_USERNAME, C_PASSWORD, C_DATABASE);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	return $conn;
}

function get_all_events() {
	$conn = get_new_connection();

	$result = $conn->query("SELECT * FROM events");
	$results_array = array();

	while($row = $result->fetch_assoc()) {
		$results_array[] = $row;
	}

	return $results_array;
}

function get_update(){
	$conn = get_new_connection();
	$result = $conn->query("SELECT * FROM updates");
	$results_array = array();

	while($row = $result->fetch_assoc()) {
		$results_array[] = $row;
	}

	return $results_array[0];
}

function get_all_contacts() {
	$conn = get_new_connection();

	$result = $conn->query("SELECT * FROM contacts");
	$results_array = array();

	while($row = $result->fetch_assoc()) {
		$results_array[] = $row;
	}

	return $results_array;
}

function get_event($id) {
	$conn = get_new_connection();
	
	$statement = $conn->prepare("SELECT * FROM events WHERE id = ?");
	$statement->bind_param("i", $id);
	$statement->execute();

	$results_array = array();
	$statement->bind_result($r_id, $r_name, $r_category_id, $r_description, $r_file, $r_contact_id1, $r_contact_id2);

	if($statement->fetch()) {
		$results_array['id']   			= $r_id;
		$results_array['name'] 			= $r_name;
		$results_array['category_id'] 	= $r_category_id;
		$results_array['description'] 	= $r_description;
		$results_array['file'] 			= $r_file;
		$results_array['contact_id1'] 	= $r_contact_id1;
		$results_array['contact_id2'] 	= $r_contact_id2;
	}

	return $results_array;
}

function get_contact($id) {
	$conn = get_new_connection();
	
	$statement = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
	$statement->bind_param("i", $id);
	$statement->execute();

	$results_array = array();
	$statement->bind_result($r_id, $r_name, $r_email, $r_phone, $r_facebook);

	if($statement->fetch()) {
		$results_array['id']  		= $r_id;
		$results_array['name'] 		= $r_name;
		$results_array['email']		= $r_email;
		$results_array['phone']	 	= $r_phone;
		$results_array['facebook'] 	= $r_facebook;
	}

	return $results_array;
}

function get_all_categories() {
	$conn = get_new_connection();
	
	$result = $conn->query("SELECT * FROM categories");
	$results_array = array();

	while($row = $result->fetch_assoc()) {
		$results_array[] = $row;
	}

	return $results_array;
}

function get_events_in_category($category_id) {
	$conn = get_new_connection();
	
	//$statement = $conn->prepare("SELECT * FROM events WHERE category_id = ?");
	//$statement->bind_param("i", $category_id);
	//$statement->execute();
	$sql = "SELECT * FROM events WHERE category_id = ".$category_id;
	$result = $conn->query($sql);
	$results_array = array();
	while($row = $result->fetch_assoc()) {
		$results_array[] = $row;
	}

	return $results_array;
}

function update_event($id, $description, $file = false) {
	$conn = get_new_connection();
	
	if($file === false) {
		$statement = $conn->prepare("UPDATE events SET description = ? WHERE id = ?");
		$statement->bind_param("si", $description, $id);
	}

	else {
		$statement = $conn->prepare("UPDATE events SET description = ?, file = ? WHERE id = ?");
		$statement->bind_param("ssi", $description, $file, $id);
	}

	$statement->execute();
}

function update_updates($description, $file = false) {
	$conn = get_new_connection();
	$id=1;
	
	if($file === false) {
		$statement = $conn->prepare("UPDATE updates SET description = ? WHERE id = ?");
		$statement->bind_param("si", $description, $id);
	}

	else {
		$statement = $conn->prepare("UPDATE updates SET description = ?, file = ? WHERE id = ?");
		$statement->bind_param("ssi", $description, $file, $id);
	}

	$statement->execute();
}

function set_event_contacts($event_id, $contact_id1 = false, $contact_id2 = false) {
	$conn = get_new_connection();

	if($contact_id1 != false && $contact_id2 != false) {
		$statement = $conn->prepare("UPDATE events SET contact_id1 = ?, contact_id2 = ? WHERE id = ?");
		$statement->bind_param("iii", $contact_id1, $contact_id2, $event_id);
	}

	else if($contact_id2 != false) {
		$statement = $conn->prepare("UPDATE events SET contact_id1 = ?, contact_id2 = NULL WHERE id = ?");
		$statement->bind_param("ii", $contact_id2, $event_id);
	}

	else if($contact_id1 != false) {
		$statement = $conn->prepare("UPDATE events SET contact_id1 = ?, contact_id2 = NULL WHERE id = ?");
		$statement->bind_param("ii", $contact_id1, $event_id);
	}

	else {
		$statement = $conn->prepare("UPDATE events SET contact_id1 = NULL, contact_id2 = NULL WHERE id = ?");
		$statement->bind_param("i", $event_id);	
	}

	$statement->execute();
}

function create_contact($name, $email, $phone, $facebook) {
	$conn = get_new_connection();
	$statement = $conn->prepare("INSERT INTO contacts VALUES(NULL, ?, ?, ?, ?)");
	$statement->bind_param("ssss", $name, $email, $phone, $facebook);

	$statement->execute();
}

function update_contact($id, $name, $email, $phone, $facebook) {
	$conn = get_new_connection();
	$statement = $conn->prepare("UPDATE contacts SET name = ?, email = ?, phone = ?, facebook = ? WHERE id = ?");
	$statement->bind_param("ssssi", $name, $email, $phone, $facebook, $id);

	$statement->execute();
}

