<?php
session_start();
$userIdCookie = isset($_COOKIE['remember_userId']) ? $_COOKIE['remember_userId'] : '';
$passCookie   = isset($_COOKIE['remember_pass']) ? $_COOKIE['remember_pass'] : '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-box">
        <div class="logo">
            <a href="landing.php"><img src="css/logo.jpeg" alt="Logo"></a>
        </div>
        <h2>Login</h2>
        <form action="../controllers/authControl.php" method="POST">
            <input type="text" name="userId" placeholder="User ID" required value="<?php echo htmlspecialchars($userIdCookie); ?>">
            <span id="idErr" name="idErr"><?php if(isset($_GET["idErr"])){ echo $_GET["idErr"]; } ?></span><br>
            <input type="password" name="pass" placeholder="Password" required value="<?php echo htmlspecialchars($passCookie); ?>">
            <span id="passErr" name="passErr"><?php if(isset($_GET["passErr"])){ echo $_GET["passErr"]; } ?></span><br><br>
            <div class="options">
                <label>
                    <input type="checkbox" name="remember_me" <?php if($userIdCookie) echo "checked"; ?>> Remember me
                </label>
                <a href="forget.php">Forgot password?</a>
            </div>
            <button type="submit">Login</button>
        </form>
        <span id="genErr" name="genErr"><?php if(isset($_GET["genErr"])){ echo $_GET["genErr"]; } ?></span>
        <p class="signup">
            Don't have an account? <a href="signup.php">Sign up now</a>
        </p>
    </div>
</body>
</html>
