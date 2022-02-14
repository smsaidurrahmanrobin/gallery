<?php 

class User extends Db_object {
    
protected static $db_table = "users";
public $id;
public $username;
public $password;
public $first_name;
public $last_name;
    

    
    

    
    
    
public static function verify_user($username,$password){
    
  global $database;   
    
    $username = $database->escape_string($username);
    $password = $database->escape_string($password);  

  
    $sql ="SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' ";
    
    
    
$the_result_array = self::find_this_query($sql);

return !empty($the_result_array) ? array_shift($the_result_array): false;
}    
    
    


    

    
 
public function save(){
    
    
return isset($this->id) ? $this->update() : $this->create();    
    
    
    
}    
    
    
    
public function create(){
    
    
    
    global $database;
    
    $sql = "INSERT INTO users (username, password, first_name, last_name)";
    $sql .= "VALUES ('";
    $sql .= $database->escape_string($this->username) . "','";
    $sql .= $database->escape_string($this->password) . "', '";
    $sql .= $database->escape_string($this->first_name) . "', '";
    $sql .= $database->escape_string($this->last_name) . "')";
    
    if($database->query($sql)){
        
       $this->id = $database->the_insert_id();
        
        return true; 
        echo "inserted";
    }else{
    return false;
    }
    
    
    
}  ///End of Create Method 
    
   
 //Start of Update method   
 public function update(){
     
global $database;     
 
$sql = "UPDATE users SET ";
$sql .= "username= '" . $database->escape_string($this->username) . "', ";
$sql .= "password= '" . $database->escape_string($this->password) . "', ";
$sql .= "first_name= '" . $database->escape_string($this->first_name) . "', ";
$sql .= "last_name= '" . $database->escape_string($this->last_name) . "' ";     
$sql .= " WHERE id= " . $database->escape_string($this->id);     
     
 $database->query($sql);    
 return (mysqli_affected_rows($database->connection) == 1) ? true : false;    
     
 } //End of Update method  
    
    
    
    
//Start of Delete method   
 public function delete(){
     
global $database;     
 
$sql = "DELETE FROM users ";
$sql .= " WHERE id= " . $database->escape_string($this->id);     
$sql .= " LIMIT 1";     
     
 $database->query($sql);    
 return (mysqli_affected_rows($database->connection) == 1) ? true : false;    
     
 } //End of Delete method      
    
    
    
    
    
} ///END OF CLASS User



?>