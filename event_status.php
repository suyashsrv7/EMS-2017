<script >
	var i=0;
</script>

<?php
include_once'dbconnect.php';



?>

<table>
 <tr>
    <th>Event ID</th>
    <th>Event Name</th>
    <th>Coordinator Name</th>
    <th>Event Categry</th>
    <th>Start_at</th>
    <th>End_at</th>
    

      <th style="color: red;">Status</th>
    </tr>
</table>


    
<?php

    
    
   
  
  $stmt=$pdo->prepare("SELECT * FROM events");
  $stmt->execute();

  while($row=$stmt->fetch(PDO::FETCH_ASSOC))

  {

    
    
    
      ?>
      <div id="response">
      </div>

      <?php

     
 
         
        echo "<table><tr>";
        $id=$row['organiser_id'];
        
        $stmt1=$pdo->prepare("SELECT * FROM event_organiser WHERE user_id=:id");
        $stmt1->bindparam(":id",$id);
        $stmt1->execute();
        $row1=$stmt1->fetch(PDO::FETCH_ASSOC);


        $organiser_name=$row1['organiser_name'];
        

        
        $organiser_description=$row1['organiser_description'];
        ?>
        
        <?php

          echo"<td>".$row['event_id']."</td>";
          echo"<td>".$row['title']."</td> ";
          echo"<td>".$organiser_name."</td>";
          echo"<td>".$row['event_category']."</td>";
          echo"<td>".$row['start']."</td>";
          echo"<td>".$row["end"]."</td>";
          
          
            $k=$row['event_id'];

          ?>

          
<td>
<button name="app" id="approve" class="Approve" value="<?php echo $k ?>" name="app">approve</button>
</td>
<td>
<button name="can" id="cancel"  class="Cancel"  value="<?php echo $k ?>">cancel</button>
</td>

<form action="view_info.php" method="post">
<td>
<button type="submit" class="View" value="<?php echo $k ?>" name="view_event">view_event</button>
</td>
<td>
<button type="submit" value="<?php echo $k?>" name="view_organiser">view_organiser</button>
</form>

</td>

    <?php
        
        
         echo"</tr></table>";
         
        
      }
   
 ?>

 <script type = "text/javascript"  src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    
    </script>
    <script type = "text/javascript">
    $(document).ready(function()
    {
      window.alert("a");
    $(".Approve").click(function(event)
    {  
      var id=$(this).val();
      var name=$(this).attr('name');
      $("#response").load('set.php', {"id":id, "name":name});
      $(this).closest('tr').remove();
    });


    $(".Cancel").click(function(event)
    { 
      $("#hide").hide(10000);
      var id=$(this).val();
      var name=$(this).attr('name');
      $("#response").load('set.php', {"id":id, "name":name});
      $(this).closest('tr').remove();
    });

   });
       
    </script>
   