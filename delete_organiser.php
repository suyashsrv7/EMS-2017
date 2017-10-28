<?php
require_once'dbconnect.php';
?>
    <table>
    <tr>
      <th>Organiser ID</th>
      <th>Organiser Name</th>
      <th>organiser Contact</th>
      <th>Organiser Email</th>
      <th>Organiser Address</th>
      <th style="color: red;">Status</th>
    </tr>
     </table>


     <script type = "text/javascript"  src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    
   </script> 
  

         <script type = "text/javascript"> 
         window.alert("a");
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

<?php

$stmt= $pdo->prepare("SELECT * FROM event_organiser");
$stmt->execute();

?>
     
      <div id="response">
      </div>

<?php
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
        $user_id=$row["user_id"];
        $stmt1=$pdo->prepare("SELECT * FROM user WHERE user_id=:id");
        $stmt1->bindparam(":id",$user_id);
        $stmt1->execute();
        $row1=$stmt1->fetch(PDO::FETCH_ASSOC);

        echo "<table><tr>";
        echo "<td>".$row['user_id']."</td>";
        echo "<td>".$row['organiser_name']."</td> ";
        echo "<td>".$row['contact_no']."</td>";
        echo "<td>".$row1["email"]."</td>";
        echo "<td>".$row["address"]."</td>";
      
      
          
          $k=$row['user_id'];
          

          ?>

          
<td>
<button name="delete_organiser" id="delete" class="Delete" value="<?php echo $k ?>">delete</button>
</td>
<form action="view_info.php" method="post">
<td>
<button type="submit" value="<?php echo $k?>" name="view_organiser">view_organiser</button>
</td>
</form>



    <?php
        
        
         echo"</tr></table>";
         
        
      }
  
 ?>
