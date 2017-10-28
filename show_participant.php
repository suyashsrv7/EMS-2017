<?php

require_once'dbconnect.php';

?>
<table>
 <tr>
    <th>Participant ID</th>
    <th>Participant Name</th>
    <th>Participant Contact</th>
    <th>Participant Email</th>
    <th>Participant Address</th>
    
     
</tr>
</table>
<?php
    
	 $event=$_REQUEST["event"];
	
	
	
    $stmt=$pdo->prepare("SELECT * FROM events WHERE title=:event");
    $stmt->bindparam(":event",$event);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    $event_id=$row['event_id'];
    //$rows=$stmt->countRows();
  
    $stmt1=$pdo->prepare("SELECT * FROM event_participants WHERE event_id=:event_id");
    $stmt1->bindparam(":event_id",$event_id);
    $stmt1->execute();
    
    $rows = $stmt1->rowCount();
    

    while($rows>0)
    { 


    $row1=$stmt1->fetch(PDO::FETCH_ASSOC);
    $participant_id=$row1['participant_id'];
    

    $stmt3=$pdo->prepare("SELECT * FROM participants INNER JOIN user ON user.user_id=participants.user_id AND user.user_id=:id");
    $stmt3->bindparam(":id",$participant_id);
    $stmt3->execute();
    $row3=$stmt3->fetch(PDO::FETCH_ASSOC);
  
        

      echo "<table><tr>";
      echo"<td>".$row3['user_id']."</td>";
      echo"<td>".$row3['firstname']."</td> ";
      echo"<td>".$row3['lastname']."</td>";
      echo"<td>".$row3['contact_no']."</td>";
      echo"<td>".$row3['email']."</td>";
      echo"<td>".$row3["address"]."</td>";
      
   
     
      ?>
      <td>
      <button name="delete_participant" id="delete" class="Delete" value="<?php echo $participant_id?>">Delete</button>
       </td>
       <?php
       echo "</table></tr>";
        $rows=$rows-1;


      }
      
      ?>

      <script type = "text/javascript"  src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    
      </script> 
  

      <script type = "text/javascript"> 
         
         $(document).ready(function(){
         window.alert("a");
         $(".Delete").click(function(event)
           {
            var id=$(this).val();
            var name=$(this).attr("name");
            window.alert(id);
            $("#response").load('delete.php', {"id":id, "name":name} );
           });
        });
           </script>

           