<?php

?>

<html>
<head>	
	<title>Test 1</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="/js/jqBootstrapValidation.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
	<div class="controls">
		<p id="message"></p>
	</div>
	<form class="form-horizontal" id="user-form" action="handle_submit.php" method="POST">
		<div class="control-group">
			<label class="control-label">Name</label>
			<div class="controls">

				<input type="text" name="name" required />
				<p class="help-block"></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Surname</label>
			<div class="controls">
				<input type="text" name="surname" required />
				<p class="help-block"></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">ID Number</label>
			<div class="controls">
				<p class="help-block" id="id-num-error"></p>
				<input type="text" id="identity_no" name="identity_no" min=13 max=13 required />
				<p class="help-block"></p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label">Date of Birth</label>
			<div class="controls">
				<input type="date" name="dob" required />
				<p class="help-block"></p>
			</div>
		</div>
		<button type="submit">POST</button>
		<button type="submit">CANCEL</button>
	</form>
</body>

<script>
$(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
let searchParams = new URLSearchParams(windowsearchParams.has('sent').location.search)
if(searchParams.has('message')){
	$("#message").html(searchParams.get('message'));
}
$("#user-form").submit(function(e) { 
	e.preventDefault();
	e.returnValue = false;

   var $form = $(this);
    $.ajax({ 
     type: 'get',
     url: "handle_submit.php?identity_no=" + $("#identity_no").val(), 
     method:"GET",
     dataType: "json",
     success: function(data) { 
      if(!data.exists){
        this.submit();
      }else{
        if(!data.error){
        	$("#id-num-error").text('');
        	if(data.exists){
        		$("#identity_no").val('');
          		$("#id-num-error").text('That ID Number exists');
        	}
          	
        }else{
        	$("#message").text('Error occured: ' + data.message);
        }
        if(data.email){
          $("#email").val('');
          $("#email-error").text('That email  is already taken.');
        }
      }
    },
    error: function(request, status, error) {  alert(request.responseText);
    }
});
});
</script>
</html>