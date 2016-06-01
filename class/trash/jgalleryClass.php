<?php
include_once("database.php");
class jgallery{ 

	// **********************
	// ATTRIBUTE DECLARATION
	// **********************
	var $id;   
	var $name;   
	var $description;   
	var $img_name;   
	var $category;   
	var $link;   
	var $arrangement;   
	var $date_created;   


	var $database; // Instance of class database

	// **********************
	// CONSTRUCTOR METHOD
	// **********************
	function jgallery(){
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
	function getdescription(){
		return $this->description;
	}
	function getimg_name(){
		return $this->img_name;
	}
	function getcategory(){
		return $this->category;
	}
	function getlink(){
		return $this->link;
	}
	function getarrangement(){
		return $this->arrangement;
	}
	function getdate_created(){
		return $this->date_created;
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
	function setdescription($desc){
		return $this->description = $desc ;
	}
	function setimg_name($img_name){
		return $this->img_name = $img_name;
	}
	function setcategory($category){
		return $this->category = $category;
	}
	function setlink($link){
		return $this->link = $link;
	}
	function setarrangement($arrng){
		return $this->arrangement = $arrng;
	}
	function setdate_created($date_created){
		return $this->date_created = $date_created;
	}

	
	// **********************
	// INIT METHOD
	// **********************
	public function init($row){
		$this->id = $row->id;		
		$this->name = $row->name;
		$this->description = $row->description;
		$this->img_name	= $row->img_name;
		$this->category = $row->category;
		$this->link = $row->link;
		$this->arrangement 	= $row->arrangement;
		$this->date_created	= $row->date_created;		
	}


	// *************************
	// SELECT METHOD / LOAD ALL
	// *************************
	public function selectAll($criteria = null){
		$objarray = array(); // list of objects
		$sql =  "SELECT * FROM jgallery";
				
		if ($criteria){
			$sql.= " " . $criteria;
		}		
		$result =  $this->database->query($sql);
		$result = $this->database->result;
		while($row = mysql_fetch_object($result)){
			$jgallery = new jgallery();
			$jgallery->init($row);
			array_push($objarray,$jgallery);
		}
		return $objarray;
	}
	
	// *************************
	// for User Search purppose
	// *************************
	public function selectAllsearch($criteria = null){
		$objarray = array(); // list of objects
		$sql =  "SELECT * FROM jgallery";
				
		if ($criteria){
			$sql.= " " . $criteria;
		}		
		$result =  $this->database->query($sql);
		$result = $this->database->result;
		while($row = mysql_fetch_object($result)){
			$jgallery = new jgallery();
			$jgallery->init($row);
			array_push($objarray,$jgallery);
		}
		return $objarray;
	}	
	


	// *************************
	// SELECT METHOD / LOAD ONE
	// *************************
	public function selectOne($id,$criteria = null){
	  $sql =  "SELECT * FROM jgallery WHERE id = ".$id;
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
		$sql = "DELETE FROM jgallery WHERE id = ".$id;
		$result = $this->database->query($sql);
	}

	// **********************
	// INSERT
	// **********************
	function insert(){
		// $this->user_id = ""; // clear key for autoincrement
		$sql = "INSERT INTO jgallery (id, name,  description, img_name, category, link, arrangement,  date_created )  
				VALUES('". $this->id ."',
						'". $this->name ."',
						'". $this->description ."',
						'". $this->img_name ."',
						'". $this->category ."',
						'". $this->link ."',
						'". $this->arrangement ."',
						'". $this->date_created ."'
						)";				
		
		$result = $this->database->query($sql);
		$this->document_id = mysql_insert_id($this->database->link);
	}

	// **********************
	// UPDATE
	// **********************
	function update($id){
		$sql = " UPDATE jgallery SET 
				name = '". $this->name ."', 
				description = '". $this->description ."', 
				category = '". $this->category ."', 
				link = '". $this->link ."', 
				arrangement = '". $this->arrangement ."'			
				WHERE id =".$id;
		
		$result = $this->database->query($sql);
	}	


	
} 
?>