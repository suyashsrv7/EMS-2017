<?php
require_once'dbconnect.php';

class organiser
{
    private $db;

  function __construct($pdo)
   {
     $this->db=$pdo;
   }
	
 public function block_organiser($id)
 {  
 	echo"hi";
 	
 	try
    {

      $stmt=$this->db->prepare("UPDATE organiser SET blacklisted='1' WHERE organiser_id=:id");
      $stmt->bindparam(":id",$id);
      $stmt->execute();
    
     }
   catch (PDOException $e)
     {
       $e->getMessage();
     }


}

public function view_organiser_info($id)
    {

     if(isset($_POST['view_organiser']))
     {
    
     
             $stmt1=$this->db->prepare("SELECT * FROM organiser WHERE organiser_id=:id");
             $stmt1->bindparam(":id",$id);
             $stmt1->execute();
             $row1=$stmt1->fetch(PDO::FETCH_ASSOC);
             $rows=$stmt1->rowCount();
    
             $organiser_description=$row1['description'];
             echo "<table><tr>";
             echo "<td>".$organiser_description."</td>";
             echo "</tr></table>";   
    }

}

}
?>