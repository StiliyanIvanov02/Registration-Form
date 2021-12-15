<?php 

	session_start();
	
	if(isset($_SESSION['userlogin'])){
		header("Location: index.php");
	}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login form</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<div class="container h-100">
	<div class="d-flex justify-content-center h-100">
		<div class="user_card">
		<div class="d-flex justify-content-center">
				<h2 style="color: #7d4e78" class="text-muted pt-5">LOGIN</h2>
			</div>	
			<div class="d-flex justify-content-center form_container">
				<form action="login.php" method="post">
					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text"></span>					
						</div>
						<input type="text" name="email" id="email" class="form-control input_user" placeholder="Email" required>
					</div>
					<div class="input-group mb-2">
						<div class="input-group-append">
							<span class="input-group-text"></span>					
						</div>
						<input type="password" name="password" id="password" class="form-control input_pass" placeholder="Password" required>
					</div>
					<span id="message" style="color:#3f1c3f"></span>
					<div class="d-flex justify-content-center mt-3 login_container">
						<input type="submit" name="login" id="login" class="btn login_btn" value="Log in">
					</div>
			</div>
			</form>
			<div class="mt-4">
				<div class="d-flex justify-content-center links">
					Don't have an account? <a href="registration.php" class="ml-2">Sign Up</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
	$(function(){
		$('#login').click(function(e){

			var valid = this.form.checkValidity();

			if(valid){
				var email = $('#email').val();
				var password = $('#password').val();

				e.preventDefault();

				$.ajax({
					type: 'POST',
					url: 'process_login.php',
					data:  {email: email, password: password},
					success: function(data){
						if($.trim(data) === "Logged"){
							window.location.href = "index.php";
						}
						else
						{
							document.getElementById('message').textContent=data;
						}
					},
					error: function(data){
						document.getElementById('message').textContent=data;
					}
				});
			}
		});
	});
</script>
</body>
</html>