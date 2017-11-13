  <?php
  require_once 'dbconfig.php';
  ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="icon" href="images/logoic.ico">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  	<link rel="stylesheet" type="text/css" href="css/style.css">
  	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type = "text/javascript"  src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
    <title>EMS-AKGEC</title>
    </head>
    <body>
  	   <button onclick="topFunction()" id="myBtn" title="Go to top"><b>^</b></button>
  	   <nav id="navbaar" class="navbar navbar-expand-lg navbar-dark sticky-top">
  		  <a class="navbar-brand" href="index.html">
  			  <img src="images/headerlogo.png" height="45px" class="d-inline-block align-top" alt="">
  			
          <div style="vertical-align: middle; font-size: 1.5em" class="d-inline-block">
  				EMS	
  			</div>
  		  </a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  			<span class="navbar-toggler-icon"></span>
  		</button>
  		<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
  			<ul style="font-size: 1.2em" class="navbar-nav">
  				<li class="nav-item">
  					<a class="nav-link" data-toggle="modal" data-target="#OrganiserLoginModal">Create Event</a>
  				</li>
  				<li class="nav-item">
  					<a class="nav-link" href="#">Browse events<span class="sr-only"></span></a>
  				</li>
  				<li class="nav-item">
  					<a class="nav-link" data-toggle="modal" data-target="#LoginModal">Login</a>
  				</li>
  				<li class="nav-item">
  					<a class="nav-link" data-toggle="modal" data-target="#SignupModalLong">Sign Up</a>
  				</li>
  				<li class="nav-item">
  					<a class="nav-link" href="#">Help</a>
  				</li>
  			</ul>
  		</div>
  	</nav>
  	<img class="fixed-top" style="margin-top: 71px; vertical-align:top; " src="images/shadow.png" width="100%">
  	<br><br>
  	<div class="container">
  	<div class="col-md-12" style="text-align: center;font-size: 3em">
  			Upcoming Events
      </div>
      <br><br>
    <div class="row">
     <?php
      $stmt=$pdo->prepare("SELECT DISTINCT category FROM `events` WHERE status='1'");
      $stmt->execute();
      $rows=$stmt->rowCount();
     ?>

      <div class="col-12 col-md-6">
      <select class="form-control" id="exampleFormControlSelect1" name="event" class="category" >
      <option value="all_categories">all categories</option>

     <?php
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {  
      $eventcategory=$row['category'];
      ?>
      <option value="<?php echo $eventcategory;?>"><?php echo $row["category"];?></option>
      <?php
       }
       ?>
       </select>
       </div>
       <?php
       $stmt=$pdo->prepare("SELECT DISTINCT city FROM `events` WHERE status='1'");
     $stmt->execute();
     $rows=$stmt->rowCount();
    ?>
    <br><br>
     <div class="col-12 col-md-6">
       <select class="form-control" name="city" class="category" id="city">
         <option value="all">all</option>
         <?php
          while($row=$stmt->fetch(PDO::FETCH_ASSOC))
           {  
              $city=$row['city'];
          ?>
             <option value="<?php echo $city;?>"><?php echo $row["city"];?></option>
           <?php
           }
           ?>
       </select>
     </div>
<div  id="show">
   <div class="row">
    <?php
     $show->show_all();
    ?>
   </div>
</div>

  <div id="response">

  </div> 
</div>
</div>
      <br><br>
      
      
    
 </div>

 <br><br><br><br><br>
 <footer class="footer fixed-bottom">
  <div style="text-align: center; padding: 10px; color: white;" class="bg-dark">
   EMS 2017
 </div>
</footer>


	<!--<h1 style="color:white; background-color:rgba(4.683962264150937%,66.42415702982352%,100%,0.9)">PARAM MITTAL</h1>
	-->
	</body>
</html>
	
<script type = "text/javascript"> 
$(document).ready(function(){



    $(".form-control").change(function(event)
    {  
      var category=$("#exampleFormControlSelect1").val();
            var city=$("#city").val();
                 $("#show").fadeOut(1000);

                 $("#response").load('show_bycategory.php', {"category":category,"city":city});
                 $("#response").fadeIn(1000);

               });
  });
</script>
