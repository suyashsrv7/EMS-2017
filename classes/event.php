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
    
    	 $stmt=$this->db->prepare("UPDATE events SET status='3' WHERE event_id=:id");
    	 $stmt->bindparam(":id",$id);
         $stmt->execute();
    }


  public  function view_event_info($id)
    {
        
       
      
     
         $stmt=$this->db->prepare("SELECT * FROM events WHERE event_id=:id");
         $stmt->bindparam(":id",$id);
         echo $id;
         $stmt->execute();
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
         $image=$row['image'];
         $address=$row['venue'];
         $start=$row['event_start'];
         $end=$row['event_end'];
         ?>
         <img src="uploads/<?php echo $image;?>.jpg" width=50% height=30%>
         <br>
         <br>
         <br>
         <?php

         echo "description";
         echo "<br>";
         $event_description=$row['description'];
         echo "<table><tr>";
         echo "<td>".$event_description."</td>";
         echo  "<td>";
         echo  "address";
         echo    "<br>";
         echo   $address;
         echo "<br>";
         echo   "<br>";
         echo   "event timings";
         echo "<br>";
         echo  $start;
         echo "-";
         echo $end;
         echo   "</td>";
         echo "</tr>";
         echo"</table>";
       
    }
}
