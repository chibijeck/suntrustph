<?php 		

include_once("database.php");

class autoemail{ 



	// **********************

	// ATTRIBUTE DECLARATION

	// **********************
	var $id;
	var $test;
	var $day;
	var $email;
	var $database; // Instance of class database	


	// **********************

	// CONSTRUCTOR METHOD

	// **********************

	
	function autoemail(){

		$this->database = new Database();

	}	

	


	// **********************

	// GETTER METHODS

	// **********************

	
	function getid(){

		return $this->id;

	}

	
	function gettest(){

		return $this->test;

	}

	
	function getday(){

		return $this->day;

	}
	function getemail(){

		return $this->email;

	}

		


	// **********************

	// SETTER METHODS

	// **********************

	
	function setid($id){

		return $this->id = $id;

	}

	
	function settest($test){

		return $this->test = $test;

	}

	
	function setday($day){

		return $this->day = $day;

	}
	function setemail($email){

		return $this->email = $email;

	}
	


	// **********************

	// INIT METHODS

	// **********************		


	public function init($row){
		$this->id = $row->id; 
		$this->test = $row->test; 
		$this->day = $row->day; 	
		$this->email = $row->email;

	}	



	// ***************************

	//  SELECT METHOD / LOAD ALL

	// ***************************

	

	public function selectAll($criteria = null){

		$objarray = array(); // list of objects

		$sql =  "SELECT * FROM autoemail";

				

		if ($criteria){

			$sql.= " " . $criteria;

		}		

		$result =  $this->database->query($sql);

		$result = $this->database->result;

		while($row = mysql_fetch_object($result)){

			$autoemail = new autoemail();

			$autoemail->init($row);

			array_push($objarray,$autoemail);

		}

		return $objarray;

	}

		



	// ***************************

	//  SELECT METHOD / LOAD ONE

	// ***************************

	

	public function selectOne($id,$criteria = null){

	  $sql =  "SELECT * FROM autoemail WHERE id = ".$id;

	  if ($criteria){

		 $sql.= " " . $criteria;

	  } 		

	  $result =  $this->database->query($sql);

	  $result = $this->database->result;

	  $this->init(mysql_fetch_object($result));  

	}

	

	

	public function selectOneField($field,$fieldvalue,$criteria = null){

	  $sql =  "SELECT * FROM autoemail WHERE ".$field." = ' ".$fieldvalue."'";

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

		$sql = "DELETE FROM autoemail WHERE id = ".$id;

		$result = $this->database->query($sql);

	}

		



	// **********************

	// INSERT

	// **********************

	function insert(){

		$sql = "INSERT INTO autoemail (id,test,day)  

				VALUES(
						'". $this->id ."',
						'". $this->test ."',
						'". $this->day ."'

						)";		

		$result = $this->database->query($sql);

		$this->document_id = mysql_insert_id($this->database->link);

	}

		



	// **********************

	// UPDATE

	// **********************

	function update($id){

		$sql = " UPDATE autoemail SET 

					test = '". $this->test ."',
	 				day = '". $this->day ."',
	 				email = '". $this->email ."'
		

					WHERE id = ".$id;		

		$result = $this->database->query($sql);

	}	

	
 }?>