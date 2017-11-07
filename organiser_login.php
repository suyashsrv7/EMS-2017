<?php

	require("dbconfig.php");
	if($organiser->is_loggedin())
	{
		$organiser->logout();
		$organiser->redirect("loggedin.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src = "javascript/jquery-3.2.1.js"></script>
	<script type="text/javascript" src = "javascript/organiser_login.js"></script>
</head>
<body>
	<form action = "organiser_login.php" method = "post" id = "login_form">
		<input id = "login_email" type = "text" placeholder = "email" name = "email">
		<span id = "err_login_email" ><?php if(isset($err_login_email)) {echo $err_login_email;}?></span>
		<input id = "login_password" type = "password" placeholder = "password" name = "password">
		<span id = "err_login_password"><?php if(isset($err_login_password)){echo $err_login_password;}?></span>
		<input id = "login" type = "submit" name = "login" value = "login">
	</form>
	<a href = "#">forgot password ?</a> <!--forgot password sending mail-->

</body>
</html>