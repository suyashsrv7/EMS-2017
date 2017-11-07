<?php
require_once'dbconnect.php';

?>

	<table>
    <tr>
      <th>Event ID</th>
      <th>Event Name</th>
      <th>Coordinator Name</th>
      <th>Event start</th>
      <th>Event end </th>
      <th style="color: red;">Status</th>
    </tr>
  </table>
    <?php

    
$stmt=$pdo->prepare("SELECT * FROM `events` WHERE status='1'");
$stmt->execute();
$rows = $stmt->rowCount();
      //echo $rows;
?>
      <div id="response">
      </div>
    
<?php

while($rows>0)
  {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      echo "<table><tr>";
      $id=$row['organiser_id'];
        
      $stmt1=$pdo->prepare("SELECT * FROM organiser WHERE organiser_id=:id");;
      $stmt1->bindparam(":id",$id);
      $stmt1->execute();
      $row1=$stmt1->fetch(PDO::FETCH_ASSOC);
    $firstname=$row1['firstname'];
    $lastname=$row1['lastname'];
      
      $row2=$stmt1->fetch(PDO::FETCH_ASSOC);

      

      //$stmt2=$pdo->prepare("SELECT  state.state_name, state.city_name, zip_code.zipcode
      //FROM state
      //INNER JOIN zip_code ON state.city_id=zip_code.city_id");
      //$stmt2->execute();
      //$row2=$stmt2->fetch(PDO::FETCH_ASSOC);
      //$state_name=$row2["state_name"];
      //$city_name=$row2["city_name"];
      //$zip=$row2["zipcode"];
      $organiser_description=$row1['description'];

          echo "<td>".$row['event_id']."</td>";
          echo "<td>".$row['title']."</td> ";
          echo "<td>".$firstname."</td>";
          echo "<td>".$row1["email"]."</td>";
          echo "<td>".$row['category']."</td>";
          echo "<td>".$row["event_start"]."</td>";
          echo "<td>".$row["event_end"]."</td>";
      
          
          $k=$row['event_id'];
  ?>

          
        <td>
        <button name="delete_event" id="delete" class="Delete" value="<?php echo $k ?>">delete</button>
        </td>
      
        <form action="view_info.php" method="post">
        <td>
        <button type="submit" class="View" value="<?php echo $k ?>" name="view_event">view_event_info</button>
        </td>  
        <td>
        <button type="submit" value="<?php echo $k?>" name="view_organiser">view_organiser_info</button>
        </form>
        </td>

    <?php
        
        $rows=$rows-1;
         echo"</tr></table>";
         
        
      }
   
?>
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