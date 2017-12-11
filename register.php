<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
console.log("a");
</script>
<?php

require_once 'dbconfig.php';


if(!($auth->is_loggedin('user')))
{    ?> 
        <script>
        console.log("a");
            swal('Cannot Register','Please Login','error');
            
          
      </script>
      <?php
      }
      else
      {
      	$event_id=$_REQUEST['id'];
      	$participant_id=$_SESSION['id'];
            $stmt=$pdo->prepare("SELECT * FROM event_participants WHERE participant_id=:id1 AND event_id=:id2");
            $stmt->bindparam(":id1",$participant_id);
            $stmt->bindparam(":id2",$event_id);
            $stmt->execute();
            $row=$stmt->rowCount();
            if($row>0)
            {?>
             <script>
        
            swal('Already registerd','error');
            
          
      </script>"; 
      <?php    
            }
            else
            {
                  $stmt=$pdo->prepare("INSERT INTO `event_participants` (`id`, `event_id`, `participant_id`) VALUES (NULL, '$event_id', '$participant_id')");
                  $stmt->execute();
                   ?>
                    <script>
        
            swal(' registerd','you are successfully registered','success');
            
          
      </script>"; 
      <?php
            }
      }

				