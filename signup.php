<?php
	require("dbconfig.php");

	if($user->is_loggedin())
	{
		redirect("home.php");
	}

	function test_input($data) 
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	if(isset($_POST['register']))
	{
		//server side validation

		$fname = test_input($_POST['firstname']);
  	    $lname = test_input($_POST['lastname']);
	    $email = test_input($_POST['email']);    
	    $pass  = test_input($_POST['password']);
	    $cpass = test_input($_POST['c_password']);
	    setcookie("fname", $fname, time() + (86400 * 30), "/");
	    setcookie("lname", $lname, time() + (86400 * 30), "/");
	    setcookie("email", $email, time() + (86400 * 30), "/");

	    $err = null;
	    //check if fields are empty

	    if( empty($fname) || empty($lname) || empty($email) || empty($pass) || empty($cpass) )
	    {
	    	if(empty($fname))
	    	{
	    		$err['firstname'] = 'firstname cannot be empty';
	    	}

	    	if(empty($lname))
	    	{
	    		$err['lastname'] = 'lastname cannot be empty' ;
	    	}

	    	if(empty($email))
	    	{
	    		$err['email'] = 'email cannot be empty' ; 
	    	}

	    	if(empty($pass))
	    	{
	    		$err['password'] = 'password cannot be empty' ;
	    	}

	    	if(empty($cpass))
	    	{
	    		$err['cpass'] = "please confirm your password";
	    	}
		}
		else
		{

			if (!preg_match("/^[a-zA-Z ]*$/",$fname))
			{
				$err['firstname'] = "firstname must contain letters only";
			}

			if(!preg_match("/^[a-zA-Z ]*$/", $lname))
			{
				$err['lastname'] = "lastname must contain letters only";
			}

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
			{
			  $err['email'] = "Invalid email format"; 
			}

			if($pass != $cpass)
			{
				$err['cpass'] = "Password didnot match";
			}


			try
			{
				$stmt = $conn->prepare("SELECT email FROM user WHERE email=:email");
				$stmt->bindparam(":email" , $email);
		        $stmt->execute();
		        $row=$stmt->fetch(PDO::FETCH_ASSOC);

		        if($stmt->rowCount() > 0)
		        {
		         	$err['email'] = "*email already taken";
		        }

			}
			catch(PDOException $e)
	     	{
	        	echo $e->getMessage();
	     	}
        }
		if(!isset($err))
		{
			try
			{
				$stmt = $conn->prepare("SELECT email FROM user WHERE email=:email");
				$stmt->bindparam(":email" , $email);
	         	$stmt->execute();
	         	$row=$stmt->fetch(PDO::FETCH_ASSOC);

	            if($user->register($fname,$lname,$email,$pass))
				{
					//send a mail here
					$user->redirect("successfull.php");
				}
			}
			catch(PDOException $e)
     		{
        		echo $e->getMessage();
     		}
		}




	}
 
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script  type = text/javascript src = "javascript/jquery-3.2.1.js"></script>
	<style type="text/css">
		span{
			font-size: 10px;
		}
	</style>
	
</head>
<body>
	
	<script src = "javascript/validate_user.js"></script>
	<form method = "post" action = "signup.php" >
		<input id = 'fname' type = "text" name="firstname" placeholder = "Firstname" <?php if(isset($fname)) {echo "value =". $fname;}?> >
		<span id = 'err_fname'><?php if(isset($err['firstname'])){echo $err['firstname'];}?></span><br>
		<input id = 'lname' type = "text" name="lastname" placeholder = "Lastname"<?php if(isset($lname)){echo "value = ".$lname;}?>>
		<span id = 'err_lname'><?php if(isset($err['lastname'])){echo $err['lastname'];}?></span><br>
		<input id ='email' type = "text" name="email" placeholder = "Email"<?php if(isset($email)){echo "value = ".$email;}?>>
		<span id ='err_email'><?php if(isset($err['email'])){echo $err['email'];}?></span><br>
		<input id = 'pass' type = "password" name = "password" placeholder = "Password">
		<span id = 'err_pass'><?php if(isset($err['password'])){echo $err['password'];}?></span><br>
		<input id = 'cpass' type = "password" name="c_password" placeholder = "Confirm Password" >
		<span id = 'err_cpass'><?php if(isset($err['cpass'])){echo $err['cpass'];}?></span><br>
		
		<input type = "submit" name = "register" value = "register">
	</form>
</body>
</html>