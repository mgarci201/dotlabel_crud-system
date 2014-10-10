<?php
//set our header
$page_title="Authorise Host";
include_once "header.php";
?>
<?php
// get database connection
include_once 'config/database.php';
$database = new Database();
$db = $database->getConnection();

echo "<div class='right-button-margin'>";
echo "<a href='index.php' class='btn btn-default pull-right'>Display Authorised Hosts</a>";
echo "</div>";

	// if the form was submitted
	if($_POST){
 
		// instantiate our host object
		include_once 'objects/hostmachine.php';
		$hostmachine = new hostmachine($db);
 
		// set our host machine property values
		$hostmachine->ipaddress = $_POST['ipaddress'];
		$hostmachine->subnet = $_POST['subnet'];
		$hostmachine->description = $_POST['description'];
		$hostmachine->enabled = $_POST['enabled'];
 
		// create/authorise our host
		if($hostmachine->create()){
			echo "<div class=\"alert alert-success alert-dismissable\">";
				echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
				echo "Host was created.";
			echo "</div>";
		}
 
		// if unable to create host, tell the user
		else{
			echo "<div class=\"alert alert-danger alert-dismissable\">";
				echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
				echo "Sorry, unable to create host";
			echo "</div>";
		}
	}
?>
<!-- HTML form for creating/authorising host -->
<form action='create_host.php' method='post'>
 
    <table class='table table-hover table-responsive table-bordered'>
 
        <tr>
            <td>IpAddress</td>
            <td><input type='text' name='ipaddress' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Subnet</td>
            <td><input type='text' name='subnet' class='form-control' required></td>
        </tr>
 
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>
  
			<tr>
			<td>Enabled</td>
			<td><input type="hidden" name="foo" value="0" />
			<input type='checkbox' name='enabled' class='form-control' value='1' /></td>
			</tr>
 
        <tr>
            <td>
			</td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
 
    </table>
</form>

<?php
include_once "footer.php";
?>