<?php 		
include_once("database.php");
class user_role{ 

	// **********************
	// ATTRIBUTE DECLARATION
	// **********************
	var $id;
	var $name;
	var $database; // Instance of class database	

	// **********************
	// CONSTRUCTOR METHOD
	// **********************
	
	function user_role(){
		$this->database = new Database();
	}	
	

	// **********************
	// GETTER METHODS
	// **********************
	
	function getid(){
		return $this->id;
	}
	
	function getname(){
		return $this->name;
	}
		

	// **********************
	// SETTER METHODS
	// **********************
	
	function setid($id){
		return $this->id = $id;
	}
	
	function setname($name){
		return $this->name = $name;
	}
	

	// **********************
	// INIT METHODS
	// **********************		

	public function init($row){
		$this->id = $row->id; 
		$this->name = $row->name; 	
	}	

	// ***************************
	//  SELECT METHOD / LOAD ALL
	// ***************************
	
	public function selectAll($criteria = null){
		$objarray = array(); // list of objects
		$sql =  "SELECT * FROM user_role";
				
		if ($criteria){
			$sql.= " " . $criteria;
		}		
		$result =  $this->database->query($sql);
		$result = $this->database->result;
		while($row = mysql_fetch_object($result)){
			$user_role = new user_role();
			$user_role->init($row);
			array_push($objarray,$user_role);
		}
		return $objarray;
	}
		

	// ***************************
	//  SELECT METHOD / LOAD ONE
	// ***************************
	
	public function selectOne($id,$criteria = null){
	  $sql =  "SELECT * FROM user_role WHERE id = ".$id;
	  if ($criteria){
		 $sql.= " " . $criteria;
	  } 		
	  $result =  $this->database->query($sql);
	  $result = $this->database->result;
	  $this->init(mysql_fetch_object($result));  
	}
	
	
	public function selectOneField($field,$fieldvalue,$criteria = null){
	  $sql =  "SELECT * FROM user_role WHERE ".$field." = ' ".$fieldvalue."'";
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
		$sql = "DELETE FROM user_role WHERE id = ".$id;
		$result = $this->database->query($sql);
	}
		

	// **********************
	// INSERT
	// **********************
	function insert(){
		$sql = "INSERT INTO user_role (id,name)  
				VALUES(
						'". $this->id ."',
						'". $this->name ."'
						)";		
		$result = $this->database->query($sql);
		$this->document_id = mysql_insert_id($this->database->link);
	}
		

	// **********************
	// UPDATE
	// **********************
	function update($id){
		$sql = " UPDATE user_role SET 
					id = '". $this->id ."',
	 				name = '". $this->name ."'
		
					WHERE id = ".$id;		
		$result = $this->database->query($sql);
	}	
	
 }?>