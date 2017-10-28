<?php

require_once'dbconnect.php';


	$id=$_REQUEST["id"];
	$name=$_REQUEST["name"];
	
	if($name=="app")
	{    echo $id;
        $stmt1=$pdo->prepare("UPDATE events SET status='granted'  WHERE event_id=:id");
        $stmt1->bindparam(":id",$id);
        $stmt1->execute();
        echo "done";
    } 
    else
    {
        $stmt1=$pdo->prepare("UPDATE events SET status='cancelled'  WHERE event_id=:id");
        $stmt1->bindparam(":id",$id);
        $stmt1->execute();
        echo "done";
    }
    
	



?>