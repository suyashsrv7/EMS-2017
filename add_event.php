<?php

	if(isset($_POST['submit']))
	{
		$title = $_POST['title'];
		$startdate = $_POST['start'];
		$enddate = $_POST['end'];
		$starttime = $_POST['stime'];
		$endtime = $_POST['etime'];
		$category = $_POST['category'];
		$venue = $_POST['venue'];
		$image = $_FILES['image']['tmp_name'];
		$filename = $_FILES['image']['name'];
		$description = htmlspecialchars($_POST['description']);
		$id = $_SESSION['user_session'];
		$city = $_POST['city'];
		$lastid = $conn->inser_id + 1;
		$target_folder = "uploads/".$lastid.$filename;
		move_uploaded_file(4image,)

		try 
		{
			 $stmt = $pdo->prepare("INSERT INTO events (organiserid, event_start, event_end, event_start_time, event_end_time, category, title, venue, image) VALUES(:id, :start, :endd, :stime, :etime, :category, :title, :venue, :image)");
		 	
		} 
		catch (PDOException $e) {
		 	
		 } 

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src = "javascript/jquery-3.2.1.js"></script>
	<script type="text/javascript" src = "javascript/add_event.js"></script>
	<style type="text/css">

	</style>
</head>
<body>
	<form action = "add_event.php" method = "post" id = "eventForm" enctype = "multipart/form-data" name = "myform">
		<input type ="text" id = "title" name = "title" placeholder = "Event Title">
		<span id = "err_title"></span><br>
		<input  type ="Date" id = "start" name = "start" placeholder = "Starting Date">
		<span id = "err_start"></span><br>
		<input type = "Date" id = "end" name = "end" placeholder = "Ending Date">
		<span id = "err_end"></span><br>
		<input type = "time" id = "stime" name = "stime" placeholder = "Starting time">
		<span id = "err_stime"></span><br>
		<input type = "time" id = "etime" name = "etime" placeholder = "Ending time">
		<span id = "err_etime"></span><br>
		<label for = "category">Category</label>
		<select name = "category" id = "category">
			<option value = "technical">Technical</option>
			<option value = "cultural">Cultural</option>
			<option value = "sports">Sports</option>
			<option value = "literary">Literary</option>
		</select>
		<span id = "err_category"></span><br>
		<input id = "venue"  name = "venue" placeholder = "Venue">
		<span id = "err_venue"></span><br>
		<input type = "file" name = "image" id = "image" name = "image">
		<span id = "err_image"></span><br>
		<input type = "text" name = "city" id = "city" placeholder = "City">
		<span id = "err_city"></span><br>
		<input type = "text"  id = "description"  name = "description" placeholder = "Description">
		<span id = "err_description" ></span><br>
		<input type = "submit" name = "submit" value = "submit">
		
	</form>

</body>
</html>