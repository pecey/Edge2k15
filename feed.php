<?php

include('content/lib/database.php');

if(isset($_POST['event_id']))
	$event_id=$_POST['event_id'];
else
	return false;

$event_details = get_event($event_id);

$final = array();
if(isset($event_details['file']) && !empty($event_details['file'])){
	$final['status']=1;
	$final['name']=$event_details['name'];
	$final['desc']=$event_details['description'];
	//$final['file']=str_replace("/","\/",$event_details['file']);
	$final['file']=$event_details['file'];
	$final['contact1']['exists']=0;
	$final['contact2']['exists']=0;
	if(isset($event_details['contact_id1'])){
		$final['contact1']=get_contact($event_details['contact_id1']);
		$final['contact1']['exists']=1;
	}
	if(isset($event_details['contact_id2'])){
		$final['contact2']=get_contact($event_details['contact_id2']);
		$final['contact2']['exists']=1;
	}
}
else{
	$final['name']=$event_details['name'];
	$final['status']=0;
}


echo json_encode($final);



?>