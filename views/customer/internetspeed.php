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
    <title>Customer Internet Speed</title>
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
        <a href="report.php">Report</a>
        <a href="billing.php">Billing</a>
        <a href="settings.php">Settings</a>
        <a href="../logout.php" class="logout">Logout</a>
    </div>

    <!-- content -->
    <div class="content">
        <h2>Internet Speed Test</h2>
<button onclick="testSpeed()">Check Speed</button>
<p id="result"></p>

<script>
function testSpeed() {
    const imageAddr = "https://upload.wikimedia.org/wikipedia/commons/3/3f/Fronalpstock_big.jpg";
    const downloadSize = 4995374; // bytes (approx)

    let startTime, endTime;
    let downloadImg = new Image();

    startTime = new Date().getTime();
    downloadImg.src = imageAddr + "?cacheBust=" + Math.random();

    downloadImg.onload = function () {
        endTime = new Date().getTime();
        let duration = (endTime - startTime) / 1000;
        let speedBps = downloadSize / duration;
        let speedMbps = (speedBps * 8 / 1024 / 1024).toFixed(2);
        document.getElementById("result").innerHTML =
            "Download Speed: <b>" + speedMbps + " Mbps</b>";
    };
}
</script>


</div>

</body>
</html>
