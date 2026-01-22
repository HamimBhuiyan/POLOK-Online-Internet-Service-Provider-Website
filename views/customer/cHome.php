<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != 3 || !isset($_SESSION['status']) || $_SESSION['status'] != "active"){
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="css/cStyle.css">
</head>
<body>
<!-- topbar -->
<div class="topbar">
    <span>Hi, <?php echo htmlspecialchars($_SESSION['userId']); ?></span>
    <img src="../css/logo.jpeg" alt="Polok Online" class="logo">
</div>

<!--home suru -->
<div class="dashboard">
    <!-- sidebar -->
    <div class="sidebar">
        <h3>Dashboard</h3>
        <hr>
        <a href="profile.php">Profile</a>
        <a href="package.php">Packages</a>
        <a href="internetSpeed.php">Internet Speed</a>
        <a href="report.php">Report</a>
        <a href="billing.php">Billing</a>
        <a href="settings.php">Settings</a>
        <a href="../logout.php" class="logout">Logout</a>
    </div>
    <!-- content -->
    <div class="content">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['userId']); ?>!</h2>
        <p>This is your customer dashboard. Use the sidebar to navigate to different sections of your account.</p>
    </div>
</div>
</body>
</html>
