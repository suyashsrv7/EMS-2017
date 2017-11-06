<?php
	require("dbconfig.php");
	if(isset($_POST['email']) && isset($_POST['password']))
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		$err = null;
		if(($email == "") || ($password == ""))
		{
			if($email == "")
			{
				$err['err_login_email'] = "email is empty";
			}
			if($password == "" )
			{
				$err['err_login_password'] = "password is empty";
			}
		}
		else if($organiser->login($email,$password))
		{
			$err['correct'] = "correct"; // redirect can change according to design if model is usedj
		}
		else
		{
			$err['err_login_password'] = "email or password is wrong";
		}

		echo json_encode($err);
	}
	

?>