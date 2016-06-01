<?php 		
include_once("database.php");
class properties{ 

	// **********************
	// ATTRIBUTE DECLARATION
	// **********************
	var $id;
	var $panotour;
	var $title;
	var $img_name;
	var $unit_type;
	var $location;
	var $price;
	var $status;
	var $created_at;
	var $database; // Instance of class database	

	// **********************
	// CONSTRUCTOR METHOD
	// **********************
	
	function properties(){
		$this->database = new Database();
	}	
	

	// **********************
	// GETTER METHODS
	// **********************
	
	function getid(){
		return $this->id;
	}
	
	function getpanotour(){
		return $this->panotour;
	}
	
	function gettitle(){
		return $this->title;
	}
	
	function getimg_name(){
		return $this->img_name;
	}
	
	function getunit_type(){
		return $this->unit_type;
	}
	
	function getlocation(){
		return $this->location;
	}
	
	function getprice(){
		return $this->price;
	}
	
	function getstatus(){
		return $this->status;
	}
	
	function getcreated_at(){
		return $this->created_at;
	}
		

	// **********************
	// SETTER METHODS
	// **********************
	
	function setid($id){
		return $this->id = $id;
	}
	
	function setpanotour($panotour){
		return $this->panotour = $panotour;
	}
	
	function settitle($title){
		return $this->title = $title;
	}
	
	function setimg_name($img_name){
		return $this->img_name = $img_name;
	}
	
	function setunit_type($unit_type){
		return $this->unit_type = $unit_type;
	}
	
	function setlocation($location){
		return $this->location = $location;
	}
	
	function setprice($price){
		return $this->price = $price;
	}
	
	function setstatus($status){
		return $this->status = $status;
	}
	
	function setcreated_at($created_at){
		return $this->created_at = $created_at;
	}
	

	// **********************
	// INIT METHODS
	// **********************		

	public function init($row){
		$this->id = $row->id; 
		$this->panotour = $row->panotour; 
		$this->title = $row->title; 
		$this->img_name = $row->img_name; 
		$this->unit_type = $row->unit_type; 
		$this->location = $row->location; 
		$this->price = $row->price; 
		$this->status = $row->status; 
		$this->created_at = $row->created_at; 	
	}	

	// ***************************
	//  SELECT METHOD / LOAD ALL
	// ***************************
	
	public function selectAll($criteria = null){
		$objarray = array(); // list of objects
		$sql =  "SELECT * FROM properties";
				
		if ($criteria){
			$sql.= " " . $criteria;
		}		
		$result =  $this->database->query($sql);
		$result = $this->database->result;
		while($row = mysql_fetch_object($result)){
			$properties = new properties();
			$properties->init($row);
			array_push($objarray,$properties);
		}
		return $objarray;
	}
		

	// ***************************
	//  SELECT METHOD / LOAD ONE
	// ***************************
	
	public function selectOne($id,$criteria = null){
	  $sql =  "SELECT * FROM properties WHERE id = ".$id;
	  if ($criteria){
		 $sql.= " " . $criteria;
	  } 		
	  $result =  $this->database->query($sql);
	  $result = $this->database->result;
	  $this->init(mysql_fetch_object($result));  
	}
	
	
	public function selectOneField($field,$fieldvalue,$criteria = null){
	  $sql =  "SELECT * FROM properties WHERE ".$field." = ' ".$fieldvalue."'";
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
		$sql = "DELETE FROM properties WHERE id = ".$id;
		$result = $this->database->query($sql);
	}
		

	// **********************
	// INSERT
	// **********************
	function insert(){
		$sql = "INSERT INTO properties (id,panotour,title,img_name,unit_type,location,price,status,created_at)  
				VALUES(
						'". $this->id ."',
						'". $this->panotour ."',
						'". $this->title ."',
						'". $this->img_name ."',
						'". $this->unit_type ."',
						'". $this->location ."',
						'". $this->price ."',
						'". $this->status ."',
						'". $this->created_at ."'
						)";		
		$result = $this->database->query($sql);
		$this->document_id = mysql_insert_id($this->database->link);
	}
		

	// **********************
	// UPDATE
	// **********************
	function update($id){
		$sql = " UPDATE properties SET 					
					panotour = '". $this->panotour ."',
					title = '". $this->title ."',
					img_name = '". $this->img_name ."',
					unit_type = '". $this->unit_type ."',
					location = '". $this->location ."',
					price = '". $this->price ."',
					status = '". $this->status ."',
	 				created_at = '". $this->created_at ."'
		
					WHERE id = ".$id;		
		$result = $this->database->query($sql);
	}	
	
 }?>