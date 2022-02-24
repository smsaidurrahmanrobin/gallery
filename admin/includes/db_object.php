<?php 


class Db_object {
    
    
public static function find_all(){
    
return static::find_this_query("SELECT * FROM users");   
    
    
    }
    
public static function find_by_id($user_id){
    
global $database;
    
$the_result_array = static::find_this_query("SELECT * FROM users WHERE id = $user_id");

return !empty($the_result_array) ? array_shift($the_result_array): false;
    

    }   
    
    
    
public static function find_this_query($sql){
    
global $database; 
    
$result_set = $database->query($sql);

$the_object_array = array();   
while($row = mysqli_fetch_array($result_set)){
    
    $the_object_array[] = static::instantation($row);
    
    
    
}    
    
    
return $the_object_array;    
    
    
    
    
} 
    
    
public static function instantation($found_user){

   $calling_class = get_called_class();
    
    $the_object = new $calling_class;
    
    
   $the_object->id             = $found_user['id'];
   $the_object->password       = $found_user['password'];
   $the_object->first_name     = $found_user['first_name'];
   $the_object->last_name      = $found_user['last_name'];
   $the_object->username       = $found_user['username'];
                        
    
    
foreach($found_user as $attribute => $value){
    
 if($the_object->has_the_attribute($attribute)){
     
     $the_object->$attribute = $value;
     
     
 }   
    
    
    
}
    
  return $the_object;  
    
    
    
}  

private function has_the_attribute($attribute){
    
 $object_properties = get_object_vars($this);   
 return array_key_exists($attribute, $object_properties);   
    
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
       
protected function properties(){
    
    
$properties = array();
    
foreach (static::$db_table_fields as $db_field){
    
    
    if(property_exists($this, $db_field)){
        
        
        $properties[$db_field] = $this->$db_field;
        
        
    }
    
    
    
} 
    return $properties;
    
    
    
} 
    
    
protected function clean_properties() {
    
    
global $database;
    
$clean_properties = array();
    
foreach ($this->properties() as $key => $value){
    
    $clean_properties[$key] = $database->escape_string($value);
    
    
} 
    return $clean_properties;
    
    
    
    
}   
    
    
    
    
    
}






?>