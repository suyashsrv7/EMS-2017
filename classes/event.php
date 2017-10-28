<?php
require_once'dbconnect.php';

class event
 {
    private $db;


  function __construct($pdo)
   {
   $this->db=$pdo;
   }
    

   public function abort_event($id)

    {
    
    	 $stmt=$this->db->prepare("UPDATE events SET status='aborted' WHERE event_id=:id");
    	 $stmt->bindparam(":id",$id);
         $stmt->execute();
    }


  public  function view_event_info($id)
    {
        
        if(isset($_POST['view_event']))
        {
      
     
         $stmt=$this->db->prepare("SELECT description FROM events WHERE event_id=:id");
         $stmt->bindparam(":id",$id);
         $stmt->execute();
         $row=$stmt->fetch(PDO::FETCH_ASSOC);

         $event_description=$row['description'];
         echo "<table><tr>";
         echo "<td>".$event_description."</td>";
         echo "</tr></table>";
       }
    }
}
