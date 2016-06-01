<?php  
 class Database
 { // Class : begin
 
 var $host;  		//Hostname, Server
 var $password; 	//Passwort MySQL
 var $user; 		//User MySQL
 var $database; 	//Datenbankname MySQL
 var $link;
 var $query;
 var $result;
 var $rows;
 
 function Database()
 { // Method : begin 
 
 // ********** DIESE WERTE ANPASSEN **************
 // ********** ADJUST THESE VALUES HERE **********
  
  // $this->host = "localhost";        

	// // Local db
  // $this->user = "ismartpa_admin";            
  // $this->password = "admin!@#";  
  $this->user = "root";            
  $this->password = "";  
  $this->database = "ismartpa_suntrustph";    
  $this->rows = 0;

	// // Online db
  //$this->user = "root";            
 // $this->password = "";           
  //$this->database = "suntrust";    
  //$this->rows = 0;
  
  
  //ipage
    // $this->host = "aljon254.ipagemysql.com";       

  // $this->user = "suntrust";            
  // $this->password = "suntrust123";           
  // $this->database = "suntrust";    
  // $this->rows = 0;
 // **********************************************
  
 } // Method : end
 
 function OpenLink()
 { // Method : begin
  $this->link = @mysql_connect($this->host,$this->user,$this->password) or die (print "Class Database: Error while connecting to DB (link)");
 } // Method : end
 
 function SelectDB()
 { // Method : begin
 
 @mysql_select_db($this->database,$this->link) or die (print "Class Database: Error while selecting DB");
  
 } // Method : end
 
 function CloseDB()
 { // Method : begin
 mysql_close();
 } // Method : end
 
 function Query($query)
 { // Method : begin
 $this->OpenLink();
 $this->SelectDB();
 $this->query = $query;
 //echo $query;
 //$this->result = mysql_query($query,$this->link) or die (print "Class Database: Error while executing Query! Watdapak!");
 $this->result = mysql_query($query,$this->link) or die (mysql_errno()." : ".mysql_error()." Query: ".$query);
 
// $rows=mysql_affected_rows();
// old usage ereg("SELECT",$query)
if(preg_match("/SELECT/",$query))
{
 $this->rows = mysql_num_rows($this->result);
}
 
 $this->CloseDB();
 } // Method : end	
  
 } // Class : end 
?>