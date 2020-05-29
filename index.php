<!DOCTYPE html>
<html>
<head>	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<title>PERSONAL MAIL  SENDING PORTAL</title>
</head>

<style type="text/css">
	#form-div{
		padding-top: 40px;
		padding-bottom: 60px;
		-webkit-box-shadow: 3px 4px 44px -17px rgba(163,158,163,1);
		-moz-box-shadow: 3px 4px 44px -17px rgba(163,158,163,1);
		box-shadow: 3px 4px 44px -17px rgba(163,158,163,1);
	}
	.row{
		padding-top: 60px;
	}
	.error {
      color: red;
   	}
	#message{
		text-align: center;
		-webkit-box-shadow: 11px 10px 5px 0px rgba(148,145,148,1);
		-webkit-box-shadow: 2px 3px 5px 5px rgba(148,145,148,1);
		-moz-box-shadow: 2px 3px 5px 5px rgba(148,145,148,1);
		box-shadow: 2px 3px 5px 5px rgba(148,145,148,1);
	}
</style>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4">				
			</div>
			<div class="col-md-4" id="form-div">
				<h3 style="padding-bottom: 20px;">PERSONAL EMAIL SENDING APPLICATION</h3>
				<form>
				  <div class="form-group">
				    <label for="rcvr">Reciever address</label>
				    <input type="email" class="form-control" id="rcvr" name="reciever" placeholder="Enter email">
				  </div>
				  <div class="form-group">
				    <label for="sub">Email Subject</label>
				    <input type="text" class="form-control" id="sub" name="subject" placeholder="Enter subject">
				  </div>
				  <div class="form-group">
				    <label for="e_body">Email  Body</label>
				    <textarea class="form-control" id="e_body" name="email_body" placeholder="Write the body of your email here"></textarea>
				  </div>
				  <div class="form-group" id="message"></div>
				  <button type="submit" id="send" class="btn btn-primary form-control">SEND EMAIL</button>
				</form>
			</div>
			<div class="col-md-4">				
			</div>
		</div>
	</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<script>
	$('document').ready(function(){
		
		$('#message').hide();
		validateForm();

	});
</script>
<script>
	function validateForm(){

		$('form').validate({ 
				rules: {
					reciever:{
						required: true,
						email: true
					},
					subject:{
						required: true,
						minlength: 5
					},
					email_body:{
						required: true,
						minlength: 10
					}
				},
				messages: {
					reciever:{
						required: "Please provide reciever email address.",
						email: "Not a valid email address."
					},
					subject: {
						required: "Please provide a subject for your email",
						minlength: "Minimum length should be 5 characters."
					},
					email_body: {
						required: "Please provide the body of the email.",
						minlength: "Minimum length should be 10 characters."
					}
				},
				submitHandler: function (form) {
					$('#send').attr('disabled', true);

					var reciever = $('#rcvr').val().toString();
					var subject = $('#sub').val().toString();
					var email_body = $('#e_body').val().toString();

					$('#message').text("Please Wait ......");
					$('#message').css("color", "yellow");
					$('#message').show();

					$.ajax({
						url: "email.php",
						type: 'POST',
						data: {reciever:reciever, subject:subject, email_body:email_body},
						success: function(response){      
							// alert(response);
							$('#send').attr('disabled', false);
							$('#message').val("");
							$('#rcvr').val("");
							$('#sub').val("");
							$('#e_body').val("");
							$('#message').text("STATUS : "+response);
							$('#message').css( "color", "darkgreen");
							$('#message').show();
						},
						error: function(response){
							$('#send').attr('disabled', false);
							$('#message').val("");
							$('#rcvr').val("");
							$('#sub').val("");
							$('#e_body').val("");
							$('#message').text("PROCESS FAILED : "+response);
							$('#message').css( "color", "red");
							$('#message').show();
						}
					});	
				}
			})
	}
</script>
<script>
	$('#rcvr').focus(function(){
		$('#message').hide();
	});
	$('#sub').focus(function(){
		$('#message').hide();
	});
	$('#e_body').focus(function(){
		$('#message').hide();
	});
</script>
