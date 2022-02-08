<?php 

spl_autoload_register('meu_autoloader');

function meu_autoloader($class){
    
  $class = strtolower($class);

  $the_path = "includes/{$class}.php";


  if(file_exists($the_path)){

  
      include($the_path);
        
        
    }else{
      
      
      die("This file name {$class}.php was not found");
      
  }
    
   
    
}
          



?>