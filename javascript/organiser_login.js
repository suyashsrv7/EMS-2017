$(document).ready(function(){
	$("#login_form").on('submit' , function(){
		var email = $("#login_email").val();
		var password = $("#login_password").val();
		var datastring = "email="+email+"&"+"password="+password ; 

		$.ajax({
			type : "POST",
			url : "check_organiser.php",
			data : datastring,
			datatype : "json",
			cache : false,
			success : function(result){
				
				var result = $.parseJSON(result);
				console.log(result);
				if(result.correct == "correct")
				{
					window.location.href = "loggedin.php";
				}
				else
				{
					$("#err_login_email").text(result.err_login_email);
					$("#err_login_email").show();
					$("#err_login_password").text(result.err_login_password);
					$("#err_login_password").show();
				}
			}


		});
		return false;
		
	});

	$("#login_email").focus(function(){
		$("#err_login_email").hide();
		$("#err_login_email").text("");

	});
	$("#login_password").focus(function(){
		$("#err_login_password").hide();
		$("#err_login_password").hide("");
	})
})