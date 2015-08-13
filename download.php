<?php
require_once('models/Ambassador.php');

$error=0;
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$results = Ambassador::exists($id);
	if(!Ambassador::exists($id)){
		$error=1;
	}
}
else{
	$error = 1;
} 

if($error)
	echo "There were some technical issues in processing your request. Please contact the EDGE technical team";
else{
	$results = Ambassador::getDetailsById($id);


	$hit = $results['line_hits']+1;

	Ambassador::download($id, $hit);
        header('Location: http://bit.ly/1MfFCTB');
}
	
?>
