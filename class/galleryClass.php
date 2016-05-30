<?php 		
include_once("database.php");
class gallery{ 

	// **********************
	// ATTRIBUTE DECLARATION
	// **********************
	var $id;
	var $properties_id;
	var $title;
	var $img_name;
	var $arrangement;
	var $database; // Instance of class database	

	// **********************
	// CONSTRUCTOR METHOD
	// **********************
	
	function gallery(){
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
	
	function gettitle(){
		return $this->title;
	}
	
	function getimg_name(){
		return $this->img_name;
	}
	
	function getarrangement(){
		return $this->arrangement;
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
	
	function settitle($title){
		return $this->title = $title;
	}
	
	function setimg_name($img_name){
		return $this->img_name = $img_name;
	}
	
	function setarrangement($arrangement){
		return $this->arrangement = $arrangement;
	}
	

	// **********************
	// INIT METHODS
	// **********************		

	public function init($row){
		$this->id = $row->id; 
		$this->properties_id = $row->properties_id; 
		$this->title = $row->title; 
		$this->img_name = $row->img_name; 
		$this->arrangement = $row->arrangement; 	
	}	

	// ***************************
	//  SELECT METHOD / LOAD ALL
	// ***************************
	
	public function selectAll($criteria = null){
		$objarray = array(); // list of objects
		$sql =  "SELECT * FROM gallery";
				
		if ($criteria){
			$sql.= " " . $criteria;
		}		
		$result =  $this->database->query($sql);
		$result = $this->database->result;
		while($row = mysql_fetch_object($result)){
			$gallery = new gallery();
			$gallery->init($row);
			array_push($objarray,$gallery);
		}
		return $objarray;
	}
		

	// ***************************
	//  SELECT METHOD / LOAD ONE
	// ***************************
	
	public function selectOne($id,$criteria = null){
	  $sql =  "SELECT * FROM gallery WHERE id = ".$id;
	  if ($criteria){
		 $sql.= " " . $criteria;
	  } 		
	  $result =  $this->database->query($sql);
	  $result = $this->database->result;
	  $this->init(mysql_fetch_object($result));  
	}
	
	
	public function selectOneField($field,$fieldvalue,$criteria = null){
	  $sql =  "SELECT * FROM gallery WHERE ".$field." = ' ".$fieldvalue."'";
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
		$sql = "DELETE FROM gallery WHERE id = ".$id;
		$result = $this->database->query($sql);
	}
		

	// **********************
	// INSERT
	// **********************
	function insert(){
		$sql = "INSERT INTO gallery (id,properties_id,title,img_name,arrangement)  
				VALUES(
						'". $this->id ."',
						'". $this->properties_id ."',
						'". $this->title ."',
						'". $this->img_name ."',
						'". $this->arrangement ."'
						)";		
		$result = $this->database->query($sql);
		$this->document_id = mysql_insert_id($this->database->link);
	}
		

	// **********************
	// UPDATE
	// **********************
	function update($id){
		$sql = " UPDATE gallery SET 					
					properties_id = '". $this->properties_id ."',
					title = '". $this->title ."',
					img_name = '". $this->img_name ."',
	 				arrangement = '". $this->arrangement ."'
		
					WHERE id = ".$id;		
		$result = $this->database->query($sql);
	}	
	
 }?>