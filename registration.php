<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>

<div>
	<?php
	
	?>	
</div>

<div class="container h-100">
	<div class="d-flex justify-content-center h-100">
		<div class="user_card">
		<div class="d-flex justify-content-center">
				<h2 class="text-muted pt-5">REGISTER</h2>
			</div>	
			<div class="d-flex justify-content-center form_container">
				<form action="registration.php" method="post">
					<div class="input-group mb-1">
						<div class="input-group-append">
							<span class="input-group-text"></span>					
						</div>
						<input type="text" name="firstname" id="firstname" class="form-control input_user" placeholder="First name" required>
					</div>
					<div class="input-group mb-1">
						<div class="input-group-append">
							<span class="input-group-text"></span>					
						</div>
						<input type="text" name="lastname" id="lastname" class="form-control input_user" placeholder="Last name" required>
					</div>
					<div class="input-group mb-1">
						<div class="input-group-append">
							<span class="input-group-text"></span>					
						</div>
						<input type="email" name="email" id="email" class="form-control input_user" placeholder="Email" required>
					</div>
					<div class="input-group mb-1">
						<div class="input-group-append">
							<span class="input-group-text"></span>					
						</div>
						<input type="phone" name="phonenumber" id="phonenumber" class="form-control input_user" placeholder="Phone" required>
					</div>
					<div class="input-group mb-1">
						<div class="input-group-append">
							<span class="input-group-text"></span>					
						</div>
						<input type="password" name="password" id="password" class="form-control input_pass" placeholder="Password" required>
					</div>
					<input class="btn login_btn" type="submit" id="register" name="create" value="Sign Up">
			</div>
			</form>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
	$(function(){
		$('#register').click(function(e){

			var valid = this.form.checkValidity();

			if(valid){


			var firstname 	= $('#firstname').val();
			var lastname	= $('#lastname').val();
			var email 		= $('#email').val();
			var phonenumber = $('#phonenumber').val();
			var password 	= $('#password').val();
			

				e.preventDefault();	

				$.ajax({
					type: 'POST',
					url: 'process_registration.php',
					data: {firstname: firstname,lastname: lastname,email: email,phonenumber: phonenumber,password: password},
					success: function(data){
					Swal.fire({
								'title': 'Successful',
								'text': data,
								'type': 'success'
								})
							
					},
					error: function(data){
						Swal.fire({
								'title': 'Errors',
								'text': data,
								'type': 'error'
								})
					}
				});

				
			}else{
				
			}

			



		});		

		
	});
	
</script>
</body>
</html>