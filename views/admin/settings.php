<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != 1 || !isset($_SESSION['status']) || $_SESSION['status'] != "active"){
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="css/aStyle.css">
</head>
<body>


<div class="topbar">
    <span>Hi, <?php echo htmlspecialchars($_SESSION['userId']); ?></span>
    <img src="../css/logo.jpeg" alt="Polok Online" class="logo">
</div>

<div class="dashboard">

    <div class="sidebar">
        <h3>Dashboard</h3>
        <hr>
        <a href="manageA.php">Manage Accounts</a>
        <a href="manageP.php">Manage Packages</a>
        <a href="revenue.php">Revenue</a>
        <a href="report.php">Reports</a>
        <a href="settings.php">Settings</a>
        <a href="../logout.php" class="logout">Logout</a>
    </div>
    <div class="content">
        <h2>Settings</h2>
    </div>

</div>

</body>
</html>
