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

$stmt= $pdo->prepare("SELECT * FROM organiser");
$stmt->execute();

?>
     
      <div id="response">
      </div>

<?php
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
        $user_id=$row["organiser_id"];
        
       

        echo "<table><tr>";
        echo "<td>".$row['organiser_id']."</td>";
        echo "<td>".$row['organisation']."</td> ";
        echo "<td>".$row['mobile']."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["address"]."</td>";
      
      
          
          $k=$row['organiser_id'];
          

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
