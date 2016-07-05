<?php 		
include_once("database.php");
class ticket{ 

	// **********************
	// ATTRIBUTE DECLARATION
	// **********************
	var $id;
	var $properties_id;
	var $customer;
	var $agent;
	var $created_at;
	var $status;
	var $pbfr_id;
	var $database; // Instance of class database	

	// **********************
	// CONSTRUCTOR METHOD
	// **********************
	
	function ticket(){
		$this->database = new Database();
	}	
	

	// **********************
	// GETTER METHODS
	// **********************
	
	function getid(){
		return $this->id;
	}
	
	function getproperties_id(){
		return $this->properties_id;
	}
	
	function getcustomer(){
		return $this->customer;
	}
	
	function getagent(){
		return $this->agent;
	}
	
	function getcreated_at(){
		return $this->created_at;
	}
	
	function getstatus(){
		return $this->status;
	}
	
	function getpbfr_id(){
		return $this->pbfr_id;
	}
		

	// **********************
	// SETTER METHODS
	// **********************
	
	function setid($id){
		return $this->id = $id;
	}
	
	function setproperties_id($properties_id){
		return $this->properties_id = $properties_id;
	}
	
	function setcustomer($customer){
		return $this->customer = $customer;
	}
	
	function setagent($agent){
		return $this->agent = $agent;
	}
	
	function setcreated_at($created_at){
		return $this->created_at = $created_at;
	}
	
	function setstatus($status){
		return $this->status = $status;
	}
	
	function setpbfr_id($pbfr_id){
		return $this->pbfr_id = $pbfr_id;
	}
	

	// **********************
	// INIT METHODS
	// **********************		

	public function init($row){
		$this->id = $row->id; 
		$this->properties_id = $row->properties_id; 
		$this->customer = $row->customer; 
		$this->agent = $row->agent; 
		$this->created_at = $row->created_at; 
		$this->status = $row->status; 	
		$this->pbfr_id = $row->pbfr_id; 	
	}	

	// ***************************
	//  SELECT METHOD / LOAD ALL
	// ***************************
	
	public function selectAll($criteria = null){
		$objarray = array(); // list of objects
		$sql =  "SELECT * FROM ticket";
				
		if ($criteria){
			$sql.= " " . $criteria;
		}		
		$result =  $this->database->query($sql);
		$result = $this->database->result;
		while($row = mysql_fetch_object($result)){
			$ticket = new ticket();
			$ticket->init($row);
			array_push($objarray,$ticket);
		}
		return $objarray;
	}
		

	// ***************************
	//  SELECT METHOD / LOAD ONE
	// ***************************
	
	public function selectOne($id,$criteria = null){
	  $sql =  "SELECT * FROM ticket WHERE id = ".$id;
	  if ($criteria){
		 $sql.= " " . $criteria;
	  } 		
	  $result =  $this->database->query($sql);
	  $result = $this->database->result;
	  $this->init(mysql_fetch_object($result));  
	}
	
	
	public function selectOneField($field,$fieldvalue,$criteria = null){
	  $sql =  "SELECT * FROM ticket WHERE ".$field." = '".$fieldvalue."'";
	  if ($criteria){
		 $sql.= " " . $criteria;
	  } 
	  $result =  $this->database->query($sql);
	  $result = $this->database->result;
	  error_reporting(0);
	  $this->init(mysql_fetch_object($result));  
	}
		

	// **********************
	// DELETE
	// **********************
	function delete($id){
		$sql = "DELETE FROM ticket WHERE id = ".$id;
		$result = $this->database->query($sql);
	}
		

	// **********************
	// INSERT
	// **********************
	function insert(){
		$sql = "INSERT INTO ticket (id,properties_id,customer,agent,created_at,status,pbfr_id)  
				VALUES(
						'". $this->id ."',
						'". $this->properties_id ."',
						'". $this->customer ."',
						'". $this->agent ."',
						'". $this->created_at ."',
						'". $this->status ."',
						'". $this->pbfr_id ."'
						)";		
		$result = $this->database->query($sql);
		$this->document_id = mysql_insert_id($this->database->link);
	}
		

	// **********************
	// UPDATE
	// **********************
	function update($id){
		$sql = " UPDATE ticket SET 					
					properties_id = '". $this->properties_id ."',
					customer = '". $this->customer ."',
					agent = '". $this->agent ."',					
					created_at = '". $this->created_at ."',					
	 				status = '". $this->status ."'
		
					WHERE id = ".$id;		
		$result = $this->database->query($sql);
	}

	function updateOne($field,$criteria=null){
		$sql = " UPDATE ticket SET ".$field." WHERE ".$criteria;	
		$result = $this->database->query($sql);
	}
	
	public function updateStatus(){
		$sql = "SELECT * FROM ticket WHERE status <> 3 AND DATE(created_at) = '". date('Y-m-d', strtotime('-16 days')) ."' ";		
		$result = $this->database->query($sql);
		$result = $this->database->result;
		$result = mysql_fetch_object($result);
		if(!empty($result->created_at)){
			$sql = "UPDATE ticket SET status = 3 WHERE status <> 3 AND DATE(created_at) = '". date('Y-m-d', strtotime('-16 days')) ."' ";
			$result = $this->database->query($sql);
			return true;
		}
	}
	function selectLapsed(){
		$objarray = array(); // list of objects
		$sql = "SELECT * FROM ticket WHERE status = 3";		
		$result = $this->database->query($sql);
		$result = $this->database->result;
		while($row = mysql_fetch_object($result)){
			$ticket = new ticket();
			$ticket->init($row);
			array_push($objarray,$ticket);
		}
		return $objarray;
		// return $result;
	}
	function countTicket($statusID){
		$sql = " SELECT COUNT(*) FROM ticket WHERE status = " . $statusID;
		
		$result =  $this->database->query($sql);
		$result = $this->database->result;
		$count = mysql_fetch_array($result);
		return $count[0];

	}	
	
 }?>