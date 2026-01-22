<?php
require_once(__DIR__ . '/../../controllers/customerControl.php');

if(!isset($_SESSION['role']) || $_SESSION['role'] != 3 || !isset($_SESSION['status']) || $_SESSION['status'] != "active"){
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Settings</title>
    <link rel="stylesheet" href="css/cStyle.css">
</head>
<body>

<!-- topbar -->
<div class="topbar">
    <span>Hi, <?php echo htmlspecialchars($_SESSION['userId']); ?></span>
    <img src="../css/logo.jpeg" alt="Polok Online" class="logo">
</div>

<!-- home suru -->
<div class="dashboard">
    <!-- sidebar -->
    <div class="sidebar">
        <h3>Dashboard</h3>
        <hr>
        <a href="cHome.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="package.php">Packages</a>
        <a href="internetSpeed.php">Internet Speed</a>
        <a href="report.php">Report</a>
        <a href="billing.php">Billing</a>
        <a href="../logout.php" class="logout">Logout</a>
    </div>
    <!-- content -->
    <div class="content">
        <h2>Settings</h2>
        <br>
        <button id="light">Light Mode / Dark Mode</button>
</div>


   
    

</body>
</html>
