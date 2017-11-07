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

    $stmt2=$this->db->prepare("DELETE FROM participants WHERE participant_id=:id");
    $stmt2->bindparam(":id",$id);
    $stmt2->execute();


    
 }

 public function give_feedback($id,$feedback,$participant_id)
 {
   echo "done";
  $stmt=$this->db->prepare("INSERT INTO `reviews` (`id`, `event_id`, `participant_id`, `review`) VALUES (NULL, '$id', '$participant_id', '$feedback')");
  $stmt->execute();
  
 }

}
?>

  