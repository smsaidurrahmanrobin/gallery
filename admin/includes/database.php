<?php 

require_once("new_config.php");

class Database{

public $connection;  

function __construct(){
 $this->open_db_connection();  
    
}    

public function open_db_connection(){
     
    
     
 $this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);     
   
    if(mysqli_connect_errno()){
        
        die("Database connection failed badly" . mysqli_error());
        } 
     
    }  
    
    
    
public function query($sql){
    
    $result = mysqli_query($this->connection, $sql);
    
    
    return $result;
  
    confirm_query($result);
    
    
} 
    

private function confirm_query($result){
    
  if(!$result){
        
        die("Query Failed");
        
        }
    
    }    
    
public function escape_string($string){
    
    
    $escape_string = mysqli_real_escape_string($this->connection, $string);
    
    return $escape_string;
    } 
    
    
public function the_insert_id(){
    
    return mysqli_insert_id($this->connection);
    
    
}   
    

    
    
} //End of class Database

$database = new Database();









?>