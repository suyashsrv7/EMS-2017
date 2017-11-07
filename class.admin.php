<?php

class ADMIN
{
	private $db;
	function __construct($conn)
	{
		$this->db = $conn;
	}
	public function login($email, $password)
	{
		 try
	       {
	          $stmt = $this->db->prepare("SELECT * FROM admin WHERE email=:email LIMIT 1");
	          $stmt->bindparam(":email" , $email);
	          $stmt->execute();
	          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	          if($stmt->rowCount() > 0)
	          {
	             if(password_verify($password, $userRow['password']))
	             {

	                $_SESSION['user_session'] = $userRow['id'];
	                return true;
	             }
	             else
	             {
	             	return false;
	             }
	          }
	          else
	          {
	          	 return false;
	          }
	       }
	       catch(PDOException $e)
	       {
	           echo $e->getMessage();
	       }

	}

	public function is_loggedin()
	{
	    if(isset($_SESSION['user_session']))
	    {
	        return true;
	    }
	    else 
	    {
	        return false;
	    }
	}
	 
	public function redirect($url)
    {
    	header("Location: $url");
    }
	 
	public function logout()
	{
	    session_destroy();
	    unset($_SESSION['user_session']);
	    return true;
	}
}

?>