<?php 		
class user{ 
	// **********************
	// ATTRIBUTE DECLARATION
	// **********************
	var $id;
	var $username;
	var $password;
	var $email;
	var $created_at;
	var $role_id;
	var $name;
	var $age;
	var $address;
	var $civil_status;
	var $nationality;
	var $contact_name;
	var $contact_email;
	var $database; // Instance of class database	

	// **********************
	// CONSTRUCTOR METHOD
	// **********************
	
	function user(){
		$this->database = new Database();
	}	
	

	// **********************
	// GETTER METHODS
	// **********************
	
	function getid(){
		return $this->id;
	}
	
	function getusername(){
		return $this->username;
	}
	
	function getpassword(){
		return $this->password;
	}
	
	function getemail(){
		return $this->email;
	}
	
	function getcreated_at(){
		return $this->created_at;
	}
	
	function getrole_id(){
		return $this->role_id;
	}
	
	function getname(){
		return $this->name;
	}
	
	function getage(){
		return $this->age;
	}
	
	function getaddress(){
		return $this->address;
	}
	
	function getcivil_status(){
		return $this->civil_status;
	}
	
	function getnationality(){
		return $this->nationality;
	}
	
	function getcontact_name(){
		return $this->contact_name;
	}
	
	function getcontact_email(){
		return $this->contact_email;
	}
		

	// **********************
	// SETTER METHODS
	// **********************
	
	function setid($id){
		return $this->id = $id;
	}
	
	function setusername($username){
		return $this->username = $username;
	}
	
	function setpassword($password){
		return $this->password = $password;
	}
	
	function setemail($email){
		return $this->email = $email;
	}
	
	function setcreated_at($created_at){
		return $this->created_at = $created_at;
	}
	
	function setrole_id($role_id){
		return $this->role_id = $role_id;
	}
	
	function setname($name){
		return $this->name = $name;
	}
	
	function setage($age){
		return $this->age = $age;
	}
	
	function setaddress($address){
		return $this->address = $address;
	}
	
	function setcivil_status($civil_status){
		return $this->civil_status = $civil_status;
	}
	
	function setnationality($nationality){
		return $this->nationality = $nationality;
	}
	
	function setcontact_name($contact_name){
		return $this->contact_name = $contact_name;
	}
	
	function setcontact_email($contact_email){
		return $this->contact_email = $contact_email;
	}
	

	// **********************
	// INIT METHODS
	// **********************		

	public function init($row){
		$this->id = $row->id; 
		$this->username = $row->username; 
		$this->password = $row->password; 
		$this->email = $row->email; 
		$this->created_at = $row->created_at; 
		$this->role_id = $row->role_id; 
		$this->name = $row->name; 
		$this->age = $row->age; 
		$this->address = $row->address; 
		$this->civil_status = $row->civil_status; 
		$this->nationality = $row->nationality; 
		$this->contact_name = $row->contact_name; 
		$this->contact_email = $row->contact_email; 	
	}	

	// ***************************
	//  SELECT METHOD / LOAD ALL
	// ***************************
	
	public function selectAll($criteria = null){
		$objarray = array(); // list of objects
		$sql =  "SELECT * FROM user";
				
		if ($criteria){
			$sql.= " " . $criteria;
		}		
		$result =  $this->database->query($sql);
		$result = $this->database->result;
		while($row = mysql_fetch_object($result)){
			$user = new user();
			$user->init($row);
			array_push($objarray,$user);
		}
		return $objarray;
	}
		

	// ***************************
	//  SELECT METHOD / LOAD ONE
	// ***************************
	
	public function selectOne($id,$criteria = null){
	  $sql =  "SELECT * FROM user WHERE id = ".$id;
	  if ($criteria){
		 $sql.= " " . $criteria;
	  } 		
	  $result =  $this->database->query($sql);
	  $result = $this->database->result;
	  $this->init(mysql_fetch_object($result));  
	}
	
	
	public function selectOneField($field,$fieldvalue,$criteria = null){
	  $sql =  "SELECT * FROM user WHERE ". $field ." ='". $fieldvalue ."'";
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
		$sql = "DELETE FROM user WHERE id = ".$id;
		$result = $this->database->query($sql);
	}
		

	// **********************
	// INSERT
	// **********************
	function insert(){
		$sql = "INSERT INTO user (id,username,password,email,created_at,role_id,name,age,address,civil_status,nationality,contact_name,contact_email)  
				VALUES(
						'". $this->id ."',
						'". $this->username ."',
						'". $this->password ."',
						'". $this->email ."',
						'". $this->created_at ."',
						'". $this->role_id ."',
						'". $this->name ."',
						'". $this->age ."',
						'". $this->address ."',
						'". $this->civil_status ."',
						'". $this->nationality ."',
						'". $this->contact_name ."',
						'". $this->contact_email ."'
						)";		
		$result = $this->database->query($sql);
		$this->document_id = mysql_insert_id($this->database->link);
	}
		

	// **********************
	// UPDATE
	// **********************
	function update($id){
		$sql = " UPDATE user SET 				
					username = '". $this->username ."',
					password = '". $this->password ."',
					email = '". $this->email ."',					
					role_id = '". $this->role_id ."',
					name = '". $this->name ."',
					age = '". $this->age ."',
					address = '". $this->address ."',
					civil_status = '". $this->civil_status ."',
					nationality = '". $this->nationality ."',
					contact_name = '". $this->contact_name ."',
	 				contact_email = '". $this->contact_email ."'
		
					WHERE id = ".$id;		
		$result = $this->database->query($sql);
	}	
	
	// custom
	public function notExist($field,$fieldvalue,$criteria = null){
	  $sql =  "SELECT * FROM user WHERE ".$field." = '".$fieldvalue."'";
	  if ($criteria){
		 $sql.= " " . $criteria;
	  } 	
		//echo $sql;
	  $result =  $this->database->query($sql);
	  $result = $this->database->result;
	  error_reporting(0);
	  $this->init(mysql_fetch_object($result));  	  

		//check kung 
		if($this->getusername() == '') {
			return true;
		} else {
			return false;
		}
	}
	
	// **********************
	// activate account
	// **********************
	function activateAccount($id){
		$sql = " UPDATE user SET 								
					role_id = 1		
					WHERE id = ".$id;		
		$result = $this->database->query($sql);
	}	
	
	
 }?>