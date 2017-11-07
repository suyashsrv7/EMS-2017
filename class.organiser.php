<?php

	
	class ORGANISER
	{
		private $db;

		function __construct($conn)
		{
			$this->db = $conn;
		}

		public function registerOrganiser($fname,$lname,$email,$password,$address,$city,$mobno,$organisation,$description)
		{
			try
			{
			   $new_password = password_hash($password, PASSWORD_BCRYPT);
	   
	           $stmt = $this->db->prepare("INSERT INTO organiser (firstname, lastname, mobile, password, address, city, email, organisation, description) VALUES(:fname, :lname, :mobno, :upass, :add, :city, :email, :organisation, :description)");
	              
	           $stmt->bindparam(":fname", $fname);
	           $stmt->bindparam(":lname", $lname);
	           $stmt->bindparam(":email", $email);
	           $stmt->bindparam(":upass", $new_password);   
	           $stmt->bindparam(":mobno", $mobno);
	           $stmt->bindparam(":add", $address);
	           $stmt->bindparam(":city", $city);
	           $stmt->bindparam(":email", $email);
	           $stmt->bindparam(":organisation", $organisation);
	           $stmt->bindparam(":description", $description); 
	           $stmt->execute();
	           return $stmt;
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
	          $stmt = $this->db->prepare("SELECT * FROM organiser WHERE email=:email LIMIT 1");
	          $stmt->bindparam(":email" , $email);
	          $stmt->execute();
	          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	          if($stmt->rowCount() > 0)
	          {
	             if(password_verify($password, $userRow['password']))
	             {

	                $_SESSION['user_session'] = $userRow['organiser_id'];
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