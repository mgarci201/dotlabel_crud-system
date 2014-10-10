<?php
//set our header
$page_title="Update Host";
include_once "header.php";
?>

<?php

echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-default pull-right'>Read Host</a>";
echo "</div>";

// get ID of the host to be edited
$hostId = isset($_GET['hostId']) ? $_GET['hostId'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/hostmachine.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare our hostmachine object
$hostmachine = new Hostmachine($db);
 
// set ID property of host to be edited
$hostmachine->hostId = $hostId;
 
// read the details of hostmachine to be edited
$hostmachine->readOne();

	// if the form was submitted
	if($_POST){
 
		// set our hostmachine property values
		$hostmachine->ipaddress = $_POST['ipaddress'];
		$hostmachine->subnet = $_POST['subnet'];
		$hostmachine->description = $_POST['description'];
		$hostmachine->enabled = $_POST['enabled'];
 
		// update
		if($hostmachine->update()){
			echo "<div class=\"alert alert-success alert-dismissable\">";
				echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
				echo "Host was updated!";
			echo "</div>";
		}
 
		// if unable to update, then tell the user
		else{
			echo "<div class=\"alert alert-danger alert-dismissable\">";
				echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
				echo "Sorry we are unable to update host";
			echo "</div>";
		}
	}
?>
<form action='update_host.php?hostId=<?php echo $hostId; ?>' method='post'>
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>Ipaddress</td>
            <td><input type='text' name='ipaddress' value='<?php echo $hostmachine->ipaddress; ?>' class='form-control'></td>
        </tr>
 
        <tr>
            <td>Subnet</td>
            <td><input type='text' name='subnet' value='<?php echo $hostmachine->subnet; ?>' class='form-control'></td>
        </tr>
 
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'><?php echo $hostmachine->description; ?></textarea></td>
        </tr>
 
        <tr>
            <td>Enabled</td>
           	<td>
			<input type='checkbox' name='enabled' value='<?php echo $hostmachine->enabled; ?>'></td>
		</tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>

<?php
include_once "footer.php";
?>