<!doctype HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Email Verification</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <?php
    require_once('config.php');

    if($_GET['key'] && $_GET['token'])
    {
        $email = $_GET['key'];
        $token = $_GET['token'];

        $sql = "SELECT * FROM users WHERE token = ?";
        $stmtselect = $db->prepare($sql);
		$result = $stmtselect->execute([$token]);
        if($result)
        {
            if($stmtselect->rowCount() > 0)
            {
                $user = $stmtselect->fetch(PDO::FETCH_ASSOC);
                if($user['email_verified_at']!='0')
                {
                    $sql = "UPDATE users SET email_verified_at = now() WHERE token = ?";
                    $stmtupdate = $db->prepare($sql);
                    $result = $stmtupdate->execute([$token]);
                    $msg = "Congratulations! Your email has been verified.";
                }
                else
                {
                    $msg = "You have already verified your account with us";
                }
            }
            else
            {
                $msg = "This email has been not registered with us";
            }
        }
    }

    ?>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <h2 style="color: #7d4e78" class="text-muted pt-5">EMAIL VERIFICATION</h2>
                </div>	               
                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        <?php echo $msg; ?></p>
                    </div>
                    <div class="d-flex justify-content-center form_container">
                        <a href="login.php" class="btn login_btn">Log in</a>
                    </div> 
			    </div>             
            </div>
        </div>
    </div>
</body>
</html>