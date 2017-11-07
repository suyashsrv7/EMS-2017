<?php

include_once'dbconnect.php';
    $id='1';
    $stmt=$pdo->prepare("SELECT * FROM event_participants WHERE participant_id=:id");
    $stmt->bindparam(":id",$id);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);

   $participant=$row['participant_id'];
   echo $participant;
   $eventid=$row['event_id'];
   $rows=$stmt->rowCount();
   echo $rows;
   echo $eventid;

    $stmt1=$pdo->prepare("SELECT * FROM events WHERE event_id=:id AND status='4'");
    $stmt1->bindparam(":id",$eventid);
    $stmt1->execute();
    $rows1=$stmt1->rowCount();
    echo $rows1;


  while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))

  {   echo "1";
      echo "<br><br>";
    
?>
      <div id="response">
      </div>

      <?php   

     
 
         
       
        $id=$row1['organiser_id'];
        $title=$row1['title'];
        $eventid=$row1['event_id'];
        $image=$row1['image'];
 
?><?php
          echo"<table><tr>";
          echo "<td>";
          ?>
          <img src="uploads/<?php echo $image?>.jpg" width=10% height=10%>
          
          <button name="<?php echo $participant;?>" id="review" value="<?php echo $eventid;?>">give_feedback</button>
         
           <?php
           
           echo $row1['event_start'];
           echo "<br>";
           echo $title;
           echo "<br>";
           echo $row1['category'];
          
           ?>
           
         

         <?php
         echo "</td>";
          
          }
      ?>
      <script type = "text/javascript"  src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    
   </script> 
  

         <script type = "text/javascript"> 
         window.alert("a");
            $(document).ready(function(){
           window.alert("a");
            $("#review").click(function(event)
           {
           	
            var id=$(this).val();
            //var name=$(this).attr("name");
            window.alert(id);
            $("#response").load('give_feedback.php', {"event_id":id});
           });
        });
           </script>