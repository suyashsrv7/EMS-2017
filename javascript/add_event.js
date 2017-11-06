$(document).ready(function(){

	$('span').hide();

	function validate_title()
	{
		var val = $('#title').val();
		title = val;
		if(val == "")
		{
			$("#err_title").text("title empty");
			$("#err_title").show();
			return false;
		} 
		else if(( /^[A-z ]+$/.test(val))!=true)
		{
			$('#err_title').text("invalid firstname");
			$('#err_title').show();
			return false;
		}
		return true;
	}
    
    function validate_datetime(x,y)
    {	var id = x;
    	var val = $("#"+id).val();
    	if(val == "")
    	{
    		$("#err_"+id).text(y);
    		$("#err_"+id).show();
    		return false;
    	}
    	return true;
    }

    function validate_venue()
    {
    	var val = $("#venue").val();
    	venue = val;
    	if(val == "")
    	{
    		$("#err_venue").text("venue is empty");
    		$("#err_venue").show();
    		return false;
    	}
    	return true;
    }

    function validate_city()
	{
		var val = $('#city').val();
		city = val;
		var regex = /^[A-z ]+$/ ;//city regex
		if(val == "")
		{
			$('#err_city').text("city is empty");
			$('#err_city').show();
			return false;
		}
		else if((regex.test(val)) != true)
		{
			$('#err_city').text("invalid city name");
			$('#err_city').show();
			return false;
		}

	}

	function validate_image()
	{
		var val = $("#image").val();

		var extension = val.split('.').pop().toUpperCase();
		if(extension == "")
		{
			$("#err_image").text("please select a file");
			$("#err_image").show();
		}
		else if (extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG")
		{
    		$('#err_image').text("invalid image");
    		$('#err_image').show();
    		return false;
		}
		else
		{
			$('#err_image').hide();
			return true;
		}
	}

	$("#title").focus(function(){
		$("#err_title").hide();
	});
	$("#title").blur(function(){
		validate_title();
	});
	$("#start").focus(function(){
		$("#err_start").hide();
	});
	$("#start").blur(function(){
		validate_datetime("start","please select a date");
	});
	$("#end").focus(function(){
		$("#err_end").hide();
	});
	$("#end").blur(function(){
		validate_datetime("end", "please select a date" );
	});
	$("#stime").focus(function(){
		$("#err_stime").hide();
	});
	$("#stime").blur(function(){
		validate_datetime("stime" , "please select a time");
	});
	$("#etime").focus(function(){
		$("#err_etime").hide();
	});
	$("#etime").blur(function(){
		validate_datetime("etime" , "please select a time");
	});
	$("#venue").focus(function(){
		$("#err_venue").hide();
	});
	$("#venue").blur(function(){
		validate_venue();
	});
	$("#city").focus(function(){
		$("#err_city").hide();
	});
	$("#city").blur(function(){
		validate_city();
	});
	$("#image").change(function(){
		validate_image();
	})

	$("#eventForm").on('submit', function(){
		var err1 = validate_title();
		var err2 = validate_datetime("start","please select a date");
		var err3 = validate_datetime("end", "please select a date" );
		var err4 = validate_datetime("stime" , "please select a time");
		var err5 = validate_datetime("etime" , "please select a time");
		var err6 = validate_venue();
		var err7 = validate_city();
		var err8 =validate_image();
		if(err1 && err2 && err3 && err4 && err5 && err6 && err7 && err8)
		{
			return true;
		}
		else
		{
			return false;
		}
    });

});