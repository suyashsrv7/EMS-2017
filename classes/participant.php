<?php
require_once'dbconnect.php';

class participant
{
    private $db;
function __construct($pdo)
 {
   $this->db=$pdo;
 }


 public function delete_participant($id)
 {

    $stmt1=$this->db->prepare("DELETE FROM event_participants WHERE participant_id=:id");
    $stmt1->bindparam(":id",$id);
    $stmt1->execute();

    $stmt2=$this->db->prepare("DELETE FROM participants WHERE user_id=:id");
    $stmt2->bindparam(":id",$id);
    $stmt2->execute();


    $stmt3=$this->db->prepare("DELETE FROM user WHERE user_id=:id");
    $stmt3->bindparam(":id",$id);
    $stmt3->execute();
   
 }

}
?>

  