<?php


require_once'dbconnect.php';
require_once 'show_events.php'
?>

<?php
    $name="";
   $stmt=$pdo->prepare("SELECT * FROM `events` WHERE status='1'");

    $stmt->execute();
    $rows=$stmt->rowCount();
    echo $rows;
    
    ?>
<select name="event" class="category" id="category">
<option value="all_categories">all categories</option>

<?php

    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {  
     echo "1";
    $eventcategory=$row['category'];
    echo $eventcategory;
?>

<option value="<?php echo $eventcategory;?>"><?php echo $row["category"];?></option>

<?php
}

?>
</select>
<?php
$stmt=$pdo->prepare("SELECT * FROM `events` WHERE status='1'");

    $stmt->execute();
    $rows=$stmt->rowCount();
    echo $rows;
    
    ?>
<select name="city" class="category" id="city">
<option value="all">all</option>

<?php

    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {  
     echo "1";
    $city=$row['city'];

?>

<option value="<?php echo $city;?>"><?php echo $row["city"];?></option>

<?php
}

?>
</select>
<table>
<tr>
<td>
<div id="response">

    </div>
    </td>
    </tr>
    </table>


<div id="show">
<?php
$show->show_all();
?>
</div>
  
     <script type = "text/javascript"  src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
     <script type = "text/javascript"> 
        
            $(document).ready(function(){
             
           

            $(".category").change(function(event)
             {  
                var category=$("#category").val();
                var city=$("#city").val();
                 
                $("#show").fadeOut(1000);
                $("#response").load('show_bycategory.php', {"category":category,"city":city});
                $("#response").fadeIn(1000);

             });
        });
      </script>
       
        <?php
        
    ?>
  