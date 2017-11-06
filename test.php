<?php
	$password = "sdk158Z#";
	$password_hash = password_hash($password , PASSWORD_BCRYPT);

	echo $password_hash;	


?>