<?php

?>

<!DOCTYPE html>
<html>
<head>
    <title>Forget Password</title>
    <link rel="stylesheet" href="css/login.css"> 
</head>
<body>
    <div class="login-box">
        <div class="logo">
            <a href="landing.php"><img src="css/logo.jpeg" alt="Logo"></a>
        </div>
        <h2>Reset Password</h2>
        <form action="../controllers/forgetControl.php" method="POST">
            <input type="text" name="userId" placeholder="User ID">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="newPass" placeholder="New Password">
            <input type="password" name="confirmPass" placeholder="Confirm Password">
            <button type="submit" name="resetPassword">Reset Password</button>
        </form>
        <span id="genErr">
            <?php if(isset($_GET["genErr"])){ echo $_GET["genErr"]; } ?>
        </span>
        <p class="signup">
            Back to <a href="login.php">Login</a>
        </p>
    </div>

</body>
</html>
