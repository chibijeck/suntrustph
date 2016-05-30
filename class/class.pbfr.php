<?php 		
include_once("database.php");
class pbfr{ 

	// **********************
	// ATTRIBUTE DECLARATION
	// **********************
	var $id;
	var $properties_id;
	var $building;
	var $floor;
	var $room;
	var $status;
	var $database; // Instance of class database	

	// **********************
	// CONSTRUCTOR METHOD
	// **********************
	
	function pbfr(){
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
	
	function getbuilding(){
		return $this->building;
	}
	
	function getfloor(){
		return $this->floor;
	}
	
	function getroom(){
		return $this->room;
	}
	
	function getstatus(){
		return $this->status;
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
	
	function setbuilding($building){
		return $this->building = $building;
	}
	
	function setfloor($floor){
		return $this->floor = $floor;
	}
	
	function setroom($room){
		return $this->room = $room;
	}
	
	function setstatus($status){
		return $this->status = $status;
	}
	

	// **********************
	// INIT METHODS
	// **********************		

	public function init($row){
		$this->id = $row->id; 
		$this->properties_id = $row->properties_id; 
		$this->building = $row->building; 
		$this->floor = $row->floor; 
		$this->room = $row->room; 
		$this->status = $row->status; 	
	}	

	// ***************************
	//  SELECT METHOD / LOAD ALL
	// ***************************
	
	public function selectAll($criteria = null){
		$objarray = array(); // list of objects
		$sql =  "SELECT * FROM pbfr";
				
		if ($criteria){
			$sql.= " " . $criteria;
		}		
		$result =  $this->database->query($sql);
		$result = $this->database->result;
		while($row = mysql_fetch_object($result)){
			$pbfr = new pbfr();
			$pbfr->init($row);
			array_push($objarray,$pbfr);
		}
		return $objarray;
	}
	
	public function selectAllFullQuery($sql){
		$objarray = array(); // list of objects	
		$result =  $this->database->query($sql);
		$result = $this->database->result;
		while($row = mysql_fetch_object($result)){
			$pbfr = new pbfr();
			$pbfr->init($row);
			array_push($objarray,$pbfr);
		}
		return $objarray;
	}
		

	// ***************************
	//  SELECT METHOD / LOAD ONE
	// ***************************
	
	public function selectOne($id,$criteria = null){
	  $sql =  "SELECT * FROM pbfr WHERE id = ".$id;
	  if ($criteria){
		 $sql.= " " . $criteria;
	  } 		
	  $result =  $this->database->query($sql);
	  $result = $this->database->result;
	  $this->init(mysql_fetch_object($result));  
	}
	
	
	public function selectOneField($field,$fieldvalue,$criteria = null){
	  $sql =  "SELECT * FROM pbfr WHERE ".$field." = ' ".$fieldvalue."'";
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
		$sql = "DELETE FROM pbfr WHERE id = ".$id;
		$result = $this->database->query($sql);
	}
		

	// **********************
	// INSERT
	// **********************
	function insert(){
		$sql = "INSERT INTO pbfr (id,properties_id,building,floor,room,status)  
				VALUES(
						'". $this->id ."',
						'". $this->properties_id ."',
						'". $this->building ."',
						'". $this->floor ."',
						'". $this->room ."',
						'". $this->status ."'
						)";		
		$result = $this->database->query($sql);
		$this->document_id = mysql_insert_id($this->database->link);
	}
		

	// **********************
	// UPDATE
	// **********************
	function update($id){
		$sql = " UPDATE pbfr SET 
					properties_id = '". $this->properties_id ."',
					building = '". $this->building ."',
					floor = '". $this->floor ."',
					room = '". $this->room ."',
	 				status = '". $this->status ."'
		
					WHERE id = ".$id;		
		$result = $this->database->query($sql);
	}	
	
	function updateStatus($id){
		$sql = " UPDATE pbfr SET 					
	 				status = '". $this->status ."'		
					WHERE id = ".$id;		
		$result = $this->database->query($sql);
	}	
	
 }?>