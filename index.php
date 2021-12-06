<?php 

session_start();

	if(!isset($_SESSION['userlogin'])){
		header("Location: login.php");
	}

	if(isset($_GET['logout'])){
		session_destroy();
		unset($_SESSION);
		header("Location: login.php");
	}

	$user = $_SESSION['userlogin'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Index page</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
			<div class="d-flex justify-content-center">
				<?php
					echo '<h2 class="text-muted pt-5">WELCOME '.$user['firstname'].'!</h2>';
				?>
			</div>	
				<div class="d-flex justify-content-center form_container">
					<div class="d-flex justify-content-center mt-3 login_container">
						<a href="index.php?logout=true" class="btn login_btn">Logout</a>
					</div>
				</div>
			</div>			
		</div>
	</div>
</body>
</html>
