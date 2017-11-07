<?php
require_once'dbconnect.php';
 $name="";
    $stmt=$pdo->prepare("SELECT * FROM events WHERE status='1'");
    $stmt->execute();
    ?>

<?php
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {  
 
$eventname=$row['title'];
?>
<select name="event" id="event">
<option value=<?php echo $eventname;?>><?php echo $row["title"];?></option>
<input type="submit" class="view" name="submit">
<?php
}
?>
     <script type = "text/javascript"  src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
     <script type = "text/javascript"> 
        
            $(document).ready(function(){
             window.alert("a");
            $(".view").click(function(event)
             {
                var event=$("#event").val();
                window.alert(event);
                window.alert(event);
                $("#response").load('show_participant.php', {"event":event});
             });
        });
      </script>
       
        <?php
        
    ?>
    <div id="response">
    </div>
   