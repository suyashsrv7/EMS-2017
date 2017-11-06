<?php

	require("php_constants.php");
	$host = host;
	$dbname = dbname;

	try
	{
	     $conn = new PDO("mysql:host={$host};dbname={$dbname}",username,password);
	     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
	     echo $e->getMessage();
	}

	include 'class.user.php';
	$user = new USER($conn);
    include 'class.organiser.php';
    $organiser = new ORGANISER($conn);

?>