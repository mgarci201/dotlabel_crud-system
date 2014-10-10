<?php
//set our header
$page_title="Delete Host";
include_once "header.php";
?>

<?php
// check if value was posted
	if($_POST){
 
		// include database and object file
		include_once 'config/database.php';
		include_once 'objects/hostmachine.php';
 
		// get database connection
		$database = new Database();
		$db = $database->getConnection();
 
		// prepare host object
		$hostmachine = new Hostmachine($db);
 
		// set hostId to be deleted
		$hostmachine->hostId = $_POST['object_id'];
 
		// delete host
		if($hostmachine->delete()){
			echo "Host machine was deleted.";
		}
 
		// if unable to delete the host
		else{
			echo "Sorry unable to delete host";
 
		}
	}
?>

<?php
include_once "footer.php";
?>