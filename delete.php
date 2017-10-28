<?php

include_once'dbconnect.php';
include_once 'classes/organiser.php';  
include_once 'classes/event.php';
include_once 'classes/participant.php';
$name=$_REQUEST["name"];
$id=$_REQUEST["id"];



if($name=="delete_organiser")
{
  $organiser=new organiser($pdo);
  $organiser->block_organiser($id);
}


if($name=="delete_event")
{  
   $event=new event($pdo);
   $event->abort_event($id);
}


if($name="delete_participant")
{
	$participant=new participant($pdo); 
    $participant->delete_participant($id);
}
?>