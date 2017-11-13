<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="images/logoic.ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> 
</head>

<?php

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
   $rows=$stmt->rowCount();
   ?>
   
   <?php
   if($rows>0)
   {
     $i=1;
     while($row=$stmt->fetch(PDO::FETCH_ASSOC))

     {
    


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
      <div class="row">
      <div class="col-12 col-md-6">
      <img src="uploads/<?php echo $image?>.jpg" class="w-100 card-img" alt="image cap">
      </div>
      <br>
      <br>
      <br>
      <br>
      <div class="col-12 col-md-6">        
       <h4><?php echo $title;?></h4>
       <p><?php echo $row['event_start'];?></p>
       <p><b><?php echo $row['category'];?></b></p>
       
       <div style="text-align:center;">
         <form action="view_info.php" method="get">
         <button style="width: 80%;" type="submit" class="btn btn-primary" value="<?php echo $id;?>" name="view_event">View</button>
         </form>
       </div>
     </div>
     <br>
   </div>
   <br>
   <br>
   <?php
      }
    
    }
  }



public function show_by_category($category,$city)
{ 
  if($category=="all_categories")
  {
    if($city=="all")
      $stmt=$this->db->prepare("SELECT * FROM events WHERE status='1'");
    else
      $stmt=$this->db->prepare("SELECT * FROM events WHERE city='$city' AND status='1'");
  }
  elseif($city=="all")
  {
    if($category=="all_categories")
      $stmt=$this->db->prepare("SELECT * FROM events WHERE status='1'");
    else
      $stmt=$this->db->prepare("SELECT * FROM events WHERE category='$category' AND status='1'"); 
  }
  else
  {
    $stmt=$this->db->prepare("SELECT * FROM events WHERE category='$category' AND city='$city' AND status='1'");
  }
  $stmt->execute();
  $rows=$stmt->rowCount();
  ?>
  
    <?php
    if($rows>0)
      { 
       $i=1;
        while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
          $title=$row['title'];
          $id=$row['event_id'];
          $image=$row['image'];
          ?>
      <div class="row">
      <div class="col-12 col-md-6">
      <img src="uploads/<?php echo $image?>.jpg" class="w-100 card-img" alt="image cap">
      </div>
      <br>
      <br>
      <br>
      <br>
      <div class="col-12 col-md-6">        
       <h4><?php echo $title;?></h4>
       <p><?php echo $row['event_start'];?></p>
       <p><b><?php echo $row['category'];?></b></p>
       
       <div style="text-align:center;">
         <form action="view_info.php" method="get">
         <button style="width: 80%;" type="submit" class="btn btn-primary" value="<?php echo $id;?>" name="view_event" >View</button>
         </form>
       </div>
     </div>
     <br>
   </div>
   <br>
   <br>
   <?php
      }
    
    }
  }
}

?>












































