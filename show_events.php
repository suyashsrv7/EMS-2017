<?php
require_once 'dbconnect.php';
class show_events
{

   private $db;


  function __construct($pdo)
   {
   $this->db=$pdo;
   }
	public function show_all()
	{
       $stmt=$this->db->prepare("SELECT * FROM events WHERE status='1'");
       $stmt->execute();



  while($row=$stmt->fetch(PDO::FETCH_ASSOC))

  {
      echo "<br><br>";
    
    
    
      ?>
      <div id="response">
      </div>

      <?php

     
 
         
       
        $id=$row['organiser_id'];
        
        $stmt1=$this->db->prepare("SELECT * FROM organiser WHERE organiser_id=:id");
        $stmt1->bindparam(":id",$id);
        $stmt1->execute();
        $row1=$stmt1->fetch(PDO::FETCH_ASSOC);


        $organiser_name=$row1['organisation'];
        

        
        $organiser_description=$row1['description'];
        $title=$row['title'];
        $id=$row['event_id'];

        
        
        
         $image=$row['image'];
    
        
        ?>
        
        <?php
          echo"<table><tr>";
          echo "<td>";
          ?>
          <img src="uploads/<?php echo $image?>.jpg" width=10% height=10%>
          
          <a href="view_info.php?view_event=<?php echo $id?>">
           <?php
           
           echo $row['event_start'];
           echo "<br>";
           echo $title;
           echo "<br>";
           echo $row['category'];
          
           ?>
         </a>
         <?php
         echo "</td>";
          
           

          
	}
}

public function show_by_category($category,$city)
{
  if($category=="all_categories")
  {
    if($city=="all")
    $stmt=$this->db->prepare("SELECT * FROM events");
    else
      $stmt=$this->db->prepare("SELECT * FROM events WHERE city='$city'");
  }
 elseif($city=="all")
 {
  if($category=="all_categories")
    $stmt=$this->db->prepare("SELECT * FROM events");
  else
  $stmt=$this->db->prepare("SELECT * FROM events WHERE category='$category'"); 
 }
  else
  {
  $stmt=$this->db->prepare("SELECT * FROM events WHERE category='$category' AND city='$city'");
  }
  $stmt->execute();
 while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
{
        $title=$row['title'];
        $id=$row['event_id'];
        $image=$row['image'];
      
        
        ?>
        
        <?php
          echo"<table><tr>";
          echo "<td>";
          ?>
          <img src="uploads/<?php echo $image?>.jpg" width=10% height=10%>
          
          <a href="view_info.php?view_event=<?php echo $id?>">
           <?php
           
           echo $row['event_start'];
           echo "<br>";
           echo $title;
           echo "<br>";
           echo $row['category'];
          
           ?>
         </a>
         <?php
         echo "</td>";
}
}






}
$show=new show_events($pdo);
?>












































