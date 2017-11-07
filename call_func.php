<?php
include_once 'dbconnect.php';
include_once 'classes/participant.php';
$event_id=$_POST["event_id"];
$participant_id=$_POST["user_id"];
$feedback=$_POST["feedback"];

$participant=new participant($pdo);
$participant->give_feedback($participant_id,$feedback,$event_id);

?>