<?php

require_once'dbconnect.php';


	$id=$_POST["id"];
	$name=$_POST["name"];
	echo $name;
	if($name=="app")
	{    echo $id;
        $stmt1=$pdo->prepare("UPDATE events SET status='1'  WHERE event_id=:id");
        $stmt1->bindparam(":id",$id);
        $stmt1->execute();
        echo "done";
    } 
    else
    {
        $stmt1=$pdo->prepare("UPDATE events SET status='2'  WHERE event_id=:id");
        $stmt1->bindparam(":id",$id);
        $stmt1->execute();
        echo "done";
    }
    
	



?>