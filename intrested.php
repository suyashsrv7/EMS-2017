
<?php
require_once'dbconfig.php';
$event_id=$_REQUEST['event_id'];

if(!($auth->is_loggedin('user')))
{
   ?>
   
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
   </script>
   <script>
   console.log("a");
    swal("Your are not logged in!", {icon: "error"});
   </script>
   <?php
}
else
{

	$participant_id=$_SESSION['id'];
    $stmt1=$pdo->prepare("SELECT * FROM intrested WHERE event_id='$event_id' AND participant_id='$participant_id'");
    $stmt1->execute();
    $row=$stmt1->rowCount();
    //echo $row;
    if($row>0)
    {
  ?>


  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
   </script>
   <script>
  swal("you are already registered as intrested participant!", {icon: "error"});
  </script>

<?php

}
else
{
$stmt=$pdo->prepare("INSERT INTO intrested (event_id,participant_id) VALUES ('$event_id','$participant_id')");
$stmt->execute();
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
   </script>
<script>
swal("you are intrested in this event now!", {icon: "success"});
</script>
<?php
}
}
?>
