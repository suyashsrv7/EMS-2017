<?php
	session_start();
	class USER
	{
		private $db;

		function __construct($conn)
		{
			$this->db = $conn;
		}

		public function register($fname,$lname,$email,$password,$address,$city,$mobno)
	    {
	       try
	       {
	           $new_password = password_hash($password, PASSWORD_BCRYPT);
	   
	           $stmt = $this->db->prepare("INSERT INTO participants (firstname, lastname, mobile, password, address, city, email) 
	                                                       VALUES(:fname, :lname, :mobno, :upass, :add, :city, :email)");
	              
	           $stmt->bindparam(":fname", $fname);
	           $stmt->bindparam(":lname", $lname);
	           $stmt->bindparam(":email", $email);
	           $stmt->bindparam(":upass", $new_password);   
	           $stmt->bindparam(":mobno", $mobno);
	           $stmt->bindparam(":add", $address);
	           $stmt->bindparam(":city", $city);
	           $stmt->bindparam(":email", $email);
	           $stmt->bindparam(":email", $email);
	           $stmt->bindparam(":email", $email);
	           $stmt->execute(); 
	           return$stmt ; 
	       }
	       catch(PDOException $e)
	       {
	           echo $e->getMessage();
	       }    
	    }

	    public function login($email,$password)
	    {
	       try
	       {
	          $stmt = $this->db->prepare("SELECT * FROM participants WHERE email=:email LIMIT 1");
	          $stmt->bindparam(":email" , $email);
	          $stmt->execute();
	          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	          if($stmt->rowCount() > 0)
	          {
	             if(password_verify($password, $userRow['password']))
	             {

	                $_SESSION['user_session'] = $userRow['participant_id'];
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