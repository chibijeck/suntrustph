<?php
include_once("database.php");
class jcategory{ 

	// **********************
	// ATTRIBUTE DECLARATION
	// **********************
	var $id;   
	var $img_id;   
	var $name;  
	var $arrangement;  

	var $database; // Instance of class database

	// **********************
	// CONSTRUCTOR METHOD
	// **********************
	function jcategory(){
		$this->database = new Database();
	}


	// **********************
	// GETTER METHODS
	// **********************
	function getid(){
		return $this->id;
	}
	function getimg_id(){
		return $this->img_id;
	}
	function getname(){
		return $this->name;
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
	
	function setimg_id($img_id){
		return $this->img_id = $img_id;
	}
	function setname($name){
		return $this->name = $name ;
	}

	function setarrangement($arrng){
		return $this->arrangement = $arrng;
	}

	
	// **********************
	// INIT METHOD
	// **********************
	public function init($row){
		$this->id = $row->id;		
		$this->img_id = $row->img_id;
		$this->name = $row->name;
		$this->arrangement 	= $row->arrangement;	
	}


	// *************************
	// SELECT METHOD / LOAD ALL
	// *************************
	public function selectAll($criteria = null){
		$objarray = array(); // list of objects
		$sql =  "SELECT * FROM jcategory";
				
		if ($criteria){
			$sql.= " " . $criteria;
		}		
		$result =  $this->database->query($sql);
		$result = $this->database->result;
		while($row = mysql_fetch_object($result)){
			$jcategory = new jcategory();
			$jcategory->init($row);
			array_push($objarray,$jcategory);
		}
		return $objarray;
	}
	
	// *************************
	// for User Search purppose
	// *************************
	public function selectAllsearch($criteria = null){
		$objarray = array(); // list of objects
		$sql =  "SELECT * FROM jcategory";
				
		if ($criteria){
			$sql.= " " . $criteria;
		}		
		$result =  $this->database->query($sql);
		$result = $this->database->result;
		while($row = mysql_fetch_object($result)){
			$jcategory = new jcategory();
			$jcategory->init($row);
			array_push($objarray,$jcategory);
		}
		return $objarray;
	}	

	// *************************
	// SELECT METHOD / LOAD ONE
	// *************************
	public function selectOne($id,$criteria = null){
	  $sql =  "SELECT * FROM jcategory WHERE id = ".$id;
	  if ($criteria){
		 $sql.= " " . $criteria;
	  } 		
	  $result =  $this->database->query($sql);
	  $result = $this->database->result;
	  $this->init(mysql_fetch_object($result));  
	}
	
	public function selectOneField($field,$fieldvalue,$criteria = null){
	  $sql =  "SELECT * FROM user_main WHERE ".$field." = '".$fieldvalue."'";
	  if ($criteria){
		 $sql.= " " . $criteria;
	  } 	
		//echo $sql;
	  $result =  $this->database->query($sql);
	  $result = $this->database->result;
	  error_reporting(0);
	  $this->init(mysql_fetch_object($result));  
	}
	
	

	// **********************
	// DELETE
	// **********************
	function delete($id){
		$sql = "DELETE FROM jcategory WHERE id = ".$id;
		$result = $this->database->query($sql);
	}

	// **********************
	// INSERT
	// **********************
	function insert(){
		// $this->user_id = ""; // clear key for autoincrement
		$sql = "INSERT INTO jcategory (id, img_id,name,arrangement )  
				VALUES('". $this->id ."',
						'". $this->img_id ."',
						'". $this->name ."',		
						'". $this->arrangement ."'
						)";				
		
		$result = $this->database->query($sql);
		$this->document_id = mysql_insert_id($this->database->link);
	}

	// **********************
	// UPDATE
	// **********************
	function update($id){
		$sql = " UPDATE jcategory SET 		
				name = '". $this->name ."', 
				arrangement = '". $this->arrangement ."'			
				WHERE id =".$id;		
		$result = $this->database->query($sql);
	}	
	
} 
?>