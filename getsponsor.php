<?php
include('content/lib/database.php');

$conn = get_new_connection();

	$result = $conn->query("SELECT * FROM sponsors ORDER BY priority DESC");
	$results_array = array();

	while($row = $result->fetch_assoc()) {
		$results_array[] = $row;
	}

	echo json_encode($results_array);

?>