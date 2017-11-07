<?php
include_once 'dbconnect.php';
include_once 'classes/participant.php';
$participant=new participant($pdo);
$event_id=$_REQUEST['event_id'];
$participant_id='123';
if(isset($_POST["submit"]))
 {
     $feedback=$_POST["feedback"];
     $participant->give_feedback($event_id,$feedback,$participant_id);
     header('location:event_reviews.php');
 }
 else
 {
	?>
<h>give your feedback</h>
<form action="give_feedback.php" method="post">
<input type="hidden" name="event_id" value="<?php echo $event_id?>">
<input type="hidden" name="user_id" value="<?php echo $participant_id?>">
<input type="text" name="feedback" id="feedback">
<input type="submit" id="sub" name="submit">
</form>

<?php
}  
?>