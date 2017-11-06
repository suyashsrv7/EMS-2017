<?php
	require("dbconfig.php");

	if($user->is_loggedin())
	{
		$user->logout();
		$user->redirect("home.php");
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
	    $address = test_input($_POST['address']);
	    $mobno = test_input($_POST['mobno']);
	    $city = test_input($_POST['city']);
	    $err = null;
	    //check if fields are empty

	    if( empty($fname) || empty($lname) || empty($email) || empty($pass) || empty($cpass) || empty($address) || empty($mobno) || empty($city) )
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

	    	if(empty($address))
	    	{
	    		$err['address'] = "address is empty";
	    	}

	    	if(empty($city))
	    	{
	    		$err['city'] = "city is empty";
	    	}

	    	if(empty($mobno))
	    	{
	    		$err['mobno'] = "mobile number is empty";
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

			if(!preg_match("/^[789]\d{9}$/", $mobno ))
			{
				$err['mobno'] = "invalid mobile number";
			}

			if(!preg_match("/^[A-z ]+$/", $city))
			{
				$err['city'] = "invalid city name";
			}


			try
			{
				$stmt = $conn->prepare("SELECT email FROM participants WHERE email=:email");//according to new table naming conventions
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
				if($user->register($fname,$lname,$email,$pass,$address,$city,$mobno))
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
	<script  type = "text/javascript" src = "javascript/jquery-3.2.1.js"></script>
	<script type = "text/javascript" src = "javascript/validate_user_signup.js"></script>
	<style type="text/css">
		span{
			font-size: 10px;
		}
	</style>
	
</head>
<body>
	
	
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
		<input id = 'mobno' type = "text" name="mobno" placeholder = "Mob Number" >
		<span id = 'err_mobno'><?php if(isset($err['mobno'])){echo $err['mobno'];}?></span><br>
		<input id = 'address' type = "text" name="address" placeholder = "Address" >
		<span id = 'err_address'><?php if(isset($err['address'])){echo $err['address'];}?></span><br>
		<input id = 'city' type = "text" name="city" placeholder = "City" >
		<span id = 'err_city'><?php if(isset($err['city'])){echo $err['city'];}?></span><br>
		
		<input type = "submit" name = "register" value = "register">
	</form>
</body>
</html>