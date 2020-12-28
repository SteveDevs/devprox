<?php

?>

<html>
<head>	
	<title>Test 1</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Alertify -->
    <!-- JavaScript -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
	<div class="col-md-4 col-md-offset-4">
	<form class="form-horizontal" id="user-form" name="user-form" action="handle_submit.php" method="POST">
		<div class="control-group">
			<label class="control-label">Name</label>
			<div class="controls">
				<input type="text" name="name" id='name' class="form-control" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Surname</label>
			<div class="controls">
				<input type="text" name="surname" class="form-control" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">ID Number</label>
			<div class="controls">
				<input type="text" id="identity_no" name="identity_no" class="form-control" />
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Date of Birth</label>
			<div class="controls">
				<input id="dob" name="dob" type="text" class="form-control date-input" />
				<label class="input-group-btn" for="dob">
                <span class="btn btn-default">
                    <span class="glyphicon glyphicon-calendar"></span>
			</div>
		</div>
		<button class="btn btn-primary" type="submit">POST</button>
		<button class="btn btn-danger" id="cancel" >CANCEL</button>
	</form>
	</div>
</body>

<script>


$(function() {
	$("#cancel").click(function() {
    $(this).closest('form').find("input[type=text], textarea").val("");
	});
	const urlParams = new URLSearchParams(window.location.search);
    const success_message = urlParams.get('success_message');
    if(success_message && success_message != ''){
        alertify.success(success_message);
    }
    const error_message = urlParams.get('error_message');
    if(error_message && error_message != ''){
        alertify.error(error_message);
    }
	$('#dob').datepicker({
        format: "dd/mm/yyyy"
    });
	$("#user-form").validate({

    // Specify validation rules
    rules: {
      name: {
      	"required": true,
      	maxlength: 20,
      	minlength: 2
      },
      surname: {
      	"required": true,
      	maxlength: 20,
      	minlength: 2
      },
      dob: "required",
      identity_no: {
      	"required": true,
      	minlength: 13,
      	maxlength: 13,
      	number: true
      }

    },
    // Specify validation error messages
    messages: {
      name: {
      	required: "Please enter your name",
      	minlength: "Name needs to have at least two characters",
        maxlength: "A maximum of 20 characters allowed for name"
      },
      surname: {
      	required: "Please enter your surname",
      	minlength: "Surname needs to have at least two characters",
        maxlength: "A maximum of 20 characters allowed for surname"
      },
      identity_no: {
        required: "Please provide an identity number",
        minlength: "Identity number needs to be at least 13 characters",
        maxlength: "Identity number needs to be equal to 13 characters"
      },
      dob: "Please enter Date of Birth."
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
    	$.ajax({ 
			type: 'get',
			url: "handle_submit.php?identity_no=" + $("#identity_no").val(), 
			method:"GET",
			dataType: "json",
			success: function(data) { 
				if(!data.exists){
					form.submit();
					//$("#user-form").submit();
				}else{
					if(!data.error){
						window.history.replaceState(null, null, window.location.pathname);
						if(data.exists){
							$("#identity_no").val('');
							alertify.error('That ID Number exists');
						}

					}else{
						$("#message").text('Error occured: ' + data.message);
					}
				}
			},
			error: function(request, status, error) {  alert(request.responseText);
			}
		});
    }
  });
});
</script>
</html>