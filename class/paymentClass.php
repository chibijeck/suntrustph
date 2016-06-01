<?php 		
include_once("database.php");
class payment{ 

	// **********************
	// ATTRIBUTE DECLARATION
	// **********************
	var $id;
	var $properties_id;
	var $user_id;
	var $price;
	var $building;
	var $floor;
	var $room_number;
	var $type_of_payment;
	var $created_at;
	var $ticket_id;
	var $database; // Instance of class database	

	// **********************
	// CONSTRUCTOR METHOD
	// **********************
	
	function payment(){
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
	
	function getuser_id(){
		return $this->user_id;
	}
	
	function getprice(){
		return $this->price;
	}
	
	function getbuilding(){
		return $this->building;
	}
	
	function getfloor(){
		return $this->floor;
	}
	
	function getroom_number(){
		return $this->room_number;
	}
	
	function gettype_of_payment(){
		return $this->type_of_payment;
	}
	
	function getcreated_at(){
		return $this->created_at;
	}
	function getticket_id(){
		return $this->ticket_id;
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
	
	function setuser_id($user_id){
		return $this->user_id = $user_id;
	}
	
	function setprice($price){
		return $this->price = $price;
	}
	
	function setbuilding($building){
		return $this->building = $building;
	}
	
	function setfloor($floor){
		return $this->floor = $floor;
	}
	
	function setroom_number($room_number){
		return $this->room_number = $room_number;
	}
	
	function settype_of_payment($type_of_payment){
		return $this->type_of_payment = $type_of_payment;
	}
	
	function setcreated_at($created_at){
		return $this->created_at = $created_at;
	}
	function setticket_id($ticket_id){
		return $this->ticket_id = $ticket_id;
	}
	

	// **********************
	// INIT METHODS
	// **********************		

	public function init($row){
		$this->id = $row->id; 
		$this->properties_id = $row->properties_id; 
		$this->user_id = $row->user_id; 
		$this->price = $row->price; 
		$this->building = $row->building; 
		$this->floor = $row->floor; 
		$this->room_number = $row->room_number; 
		$this->type_of_payment = $row->type_of_payment; 
		$this->created_at = $row->created_at; 	
		$this->ticket_id = $row->ticket_id; 	
	}	

	// ***************************
	//  SELECT METHOD / LOAD ALL
	// ***************************
	
	public function selectAll($criteria = null){
		$objarray = array(); // list of objects
		$sql =  "SELECT * FROM payment";
				
		if ($criteria){
			$sql.= " " . $criteria;
		}		
		$result =  $this->database->query($sql);
		$result = $this->database->result;
		while($row = mysql_fetch_object($result)){
			$payment = new payment();
			$payment->init($row);
			array_push($objarray,$payment);
		}
		return $objarray;
	}
		

	// ***************************
	//  SELECT METHOD / LOAD ONE
	// ***************************
	
	public function selectOne($id,$criteria = null){
	  $sql =  "SELECT * FROM payment WHERE id = ".$id;
	  if ($criteria){
		 $sql.= " " . $criteria;
	  } 		
	  $result =  $this->database->query($sql);
	  $result = $this->database->result;
	  $this->init(mysql_fetch_object($result));  
	}
	
	
	public function selectOneField($field,$fieldvalue,$criteria = null){
	  $sql =  "SELECT * FROM payment WHERE {$field} = {$fieldvalue}";
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
		$sql = "DELETE FROM payment WHERE id = ".$id;
		$result = $this->database->query($sql);
	}
		

	// **********************
	// INSERT
	// **********************
	function insert(){
		$sql = "INSERT INTO payment (id,properties_id,user_id,price,building,floor,room_number,type_of_payment,created_at,ticket_id)  
				VALUES(
						'". $this->id ."',
						'". $this->properties_id ."',
						'". $this->user_id ."',
						'". $this->price ."',
						'". $this->building ."',
						'". $this->floor ."',
						'". $this->room_number ."',
						'". $this->type_of_payment ."',
						'". $this->created_at ."',
						'". $this->ticket_id ."'
						)";		
		$result = $this->database->query($sql);
		$this->document_id = mysql_insert_id($this->database->link);
	}
		

	// **********************
	// UPDATE
	// **********************
	function update($id){
		$sql = " UPDATE payment SET 					
					properties_id = '". $this->properties_id ."',
					user_id = '". $this->user_id ."',
					price = '". $this->price ."',
					building = '". $this->building ."',
					floor = '". $this->floor ."',
					room_number = '". $this->room_number ."',
					type_of_payment = '". $this->type_of_payment ."',
	 				created_at = '". $this->created_at ."'
		
					WHERE id = ".$id;		
		$result = $this->database->query($sql);
	}	
	
 }?>