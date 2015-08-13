<?php

include('content/lib/database.php');

$categories = get_all_categories();

$final = array();
$temp = array();
$temp1 = array();
$contact = array();

foreach($categories as $category){
	$temp1['category_name']=$category['name'];
	$category_events = get_events_in_category($category['id']);
	
	$temp1['category_details']=array();
	foreach($category_events as $event){
		$temp['name']=$event['name'];
		$temp['description']=$event['description'];
		$temp['file']=$event['file'];
		$temp['contacts']=array();
		if(isset($event['contact_id1'])){
			$contact=get_contact($event['contact_id1']);
			array_push($temp['contacts'], $contact);
		}/*
		else{
			$temp['contact1']='';
			$temp['contact1']['exists']=0;
		}*/
		if(isset($event['contact_id2'])){
			$contact=get_contact($event['contact_id2']);
			array_push($temp['contacts'], $contact);
		}/*
		else{
			$temp['contact2']='';
			$temp['contact2']['exists']=0;
		}*/
		
		array_push($temp1['category_details'], $temp);
	}

array_push($final, $temp1);

}
echo json_encode($final);

?>