<?php
//set our header
$page_title="Read Host";
include_once "header.php";
?>

<?php
echo "<div class='middle-button-margin'>";
echo "<a href='create_host.php' class='btn btn-default pull-middle'>Create Host</a>";
echo "</div>";

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 3;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// include database and object files
include_once 'config/database.php';
include_once 'objects/hostmachine.php';

// instantiate database and hostmachine object
$database = new Database();
$db = $database->getConnection();
$hostmachine = new Hostmachine($db);
 
// query host machines
$stmt = $hostmachine->readAll($page, $from_record_num, $records_per_page);
$num = $stmt->rowCount();
 
	// display the host machines if there are any
	if($num>0){
 
		echo "<table class='table table-hover table-responsive table-bordered'>";
			echo "<tr>";
				echo "<th>Ipaddress</th>";
				echo "<th>Subnet</th>";
				echo "<th>Description</th>";
				echo "<th>Enabled</th>";
			echo "</tr>";
 
			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
				extract($row);
 
				echo "<tr>";
					echo "<td>{$ipaddress}</td>";
					echo "<td>{$subnet}</td>";
					echo "<td>{$description}</td>";
					echo "<td>{$enabled}</td>";
					echo "<td>";
						echo "<td>";
						// link to edit and delete button
						echo "<a href='update_host.php?hostId={$hostId}' class='btn btn-default left-margin'>Edit</a>";
						echo "<a delete-id='{$hostId}' class='btn btn-default delete-object'>Delete</a>";
					echo "</td>";
					echo "</td>";
 
				echo "</tr>";
			}
		echo "</table>";

	}
// tell the user there are no host machines
else{
    echo "<div>No hosts found.</div>";
}

// paging buttons here
include_once 'pagination.php';
?>
<script>
$(document).on('click', '.delete-object', function(){
 
    var hostId = $(this).attr('delete-id');
    var q = confirm("Are you sure?");
 
    if (q == true){
 
        $.post('delete_host.php', {
            object_id: hostId
        }, function(data){
            location.reload();
        }).fail(function() {
            alert('Unable to delete.');
        });
    } 
	
    return false;
});
</script>

<?php
include_once "footer.php";
?>