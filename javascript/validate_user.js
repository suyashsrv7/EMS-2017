
$(document).ready(function(){

	function validate_fname()
	{
		var val = $('#fname').val();
	    
		if(val == '')
		{
			$('#err_fname').text("firstname empty");
			$('#err_fname').show();
		}
		else if(( /^[A-z ]+$/.test(val))!=true)
		{
			$('#err_fname').text("invalid firstname");
			$('#err_fname').show();
		}
	}

	function validate_lname()
	{
		var val = $('#lname').val();
		
		if(val == '')
		{
			$('#err_lname').text("lastname is empty");
			$('#err_lname').show();
		}
		else if(( /^[A-z ]+$/.test(val))!=true)
		{
			$('#err_lname').text("invalid lastname");
			$('#err_lname').show();
		}
	}

	function validate_email()
	{
		var val = $('#email').val();
		var reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])/;
		if(val == '')
		{
			$('#err_email').text("email is empty");
			$('#err_email').show();
		}
		else if((reg.test(val)) != true)
		{
			$('#err_email').text("invalid email");
			$('#err_email').show();
		}
	}

	function validate_password()
	{
		val = $('#pass').val();
		var reg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;  
		if(val == '')
		{
			$('#err_pass').text("password is empty");
			$('#err_pass').show();
		}
		else if((reg.test(val))!=true)
		{
			$('#err_pass').text("invalid password");
			$('#err_pass').show();
		}
	}


	function validate_cpassword()
	{
		var err_cpass;
		val = $('#cpass').val();
		var val_pass = $('#pass').val();
		if(val == '')
		{
			$('#err_cpass').text(" ");
			$('#err_cpass').show();
		}
		else if(val != val_pass)
		{
			$('#err_cpass').text("password did not match");
			$('#err_cpass').show();
		}
		else if(val == val_pass)
		{
			$('#err_cpass').text("password matched correctly");
			$('#err_cpass').show();
		}

	}

	$("#fname").blur(function(){
		validate_fname();
		
	})
	$("#fname").focus(function(){
		console.log("he");
		$(err_fname).hide();
	})
	$("#lname").blur(function(){
		validate_lname();
	})
	$("#lname").focus(function(){
		$(err_lname).hide();
	})
	$("#email").blur(function(){
		validate_email();
	})
	$("#email").focus(function(){
		$(err_email).hide();
	})
	$("#pass").blur(function(){
		validate_password();
	})
	$("#pass").focus(function(){
		$(err_pass).hide();
	})
	$("#cpass").keyup(function(){
		validate_cpassword();
	})
	$("#cpass").focus(function(){
		$(err_cpass).hide();
	})

});