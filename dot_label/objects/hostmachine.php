<?php
class Hostmachine{
 
    // database connection and table name
    private $conn;
    private $table_name = "hostmachine";
 
    // object properties
    public $hostId;
    public $ipaddress;
    public $subnet;
    public $description;
    public $enabled;
    //public $timestamp;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // create.authorise host
    function create(){
        
		// to get time-stamp for 'created' field
        //$this->getTimestamp();
 
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    ipaddress = ?, subnet = ?, description = ?, enabled = ?";
 
        $stmt = $this->conn->prepare($query);
 
        $stmt->bindParam(1, $this->ipaddress);
        $stmt->bindParam(2, $this->subnet);
        $stmt->bindParam(3, $this->description);
        $stmt->bindParam(4, $this->enabled);
        //$stmt->bindParam(5, $this->timestamp);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        } 
    }
	// used for our pagination
	public function countAll(){
 
		$query = "SELECT hostId FROM " . $this->table_name . "";
 
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
 
		$num = $stmt->rowCount();
		return $num;
	}
	// will read all records
	public function readAll($page, $from_record_num, $records_per_page){
 
		$query = "SELECT
                hostId, ipaddress, subnet, description, enabled
            FROM
                " . $this->table_name . "

            LIMIT
                {$from_record_num}, {$records_per_page}";
 
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
 
		return $stmt;
	}
	//wil read one record for update
	function readOne(){
 
		$query = "SELECT
                ipaddress, subnet, description, enabled
            FROM
                " . $this->table_name . "
            WHERE
                hostId = ?
            LIMIT
                0,1";
 
		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->hostId);
		$stmt->execute();
 
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
 
		$this->ipaddress = $row['ipaddress'];
		$this->subnet = $row['subnet'];
		$this->description = $row['description'];
		$this->enabled = $row['enabled'];
	}
	//will update our authorise host
	function update(){
 
		$query = "UPDATE
                " . $this->table_name . "
            SET
                ipaddress = :ipaddress,
                subnet = :subnet,
                description = :description,
                enabled = :enabled
            WHERE
                hostId = :hostId";
 
		$stmt = $this->conn->prepare($query);
 
		$stmt->bindParam(':ipaddress', $this->ipaddress);
		$stmt->bindParam(':subnet', $this->subnet);
		$stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':enabled', $this->enabled);
		$stmt->bindParam(':hostId', $this->hostId);
 			
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
        return false;
		}
	}
	// delete our host machine 
	function delete(){
 
		$query = "DELETE FROM " . $this->table_name . " WHERE hostId = ?";
 
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->hostId);
 
		if($result = $stmt->execute()){
				return true;
			}else{
				return false;
		}
	}
}
?>