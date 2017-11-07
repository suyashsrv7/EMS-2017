<?php

     
    

require("php_constants.php");
$host=host;
$dbname=dbname;


try{
      $pdo = new PDO("".$dbengine.":host=$dbhost; dbname=$dbname", $dbuser,$dbpassword);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    }  

     catch (PDOException $e)
     {
       $e->getMessage();
     }
     
  
   

?>
 
    
