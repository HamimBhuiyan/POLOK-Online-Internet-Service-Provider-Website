<?php
require_once(__DIR__ . '/../../controllers/customerControl.php');
require_once(__DIR__ . '/../../models/reportModel.php');

if(!isset($_SESSION['role']) || $_SESSION['role'] != 3 || $_SESSION['status'] != "active"){
    header("Location: ../login.php");
    exit();
}
$reports = getReportsByUser($_SESSION['userId']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Reports</title>
    <link rel="stylesheet" href="css/cStyle.css">
    <link rel="stylesheet" href="css/report.css">
</head>
<body>

<!-- topbar -->
<div class="topbar">
    <span>Hi, <?= htmlspecialchars($_SESSION['userId']) ?></span>
    <img src="../css/logo.jpeg" class="logo">
</div>

<div class="dashboard">
    <div class="sidebar">
        <h3>Dashboard</h3>
        <hr>
        <a href="cHome.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="package.php">Package</a>
        <a href="internetSpeed.php">Internet Speed</a>
        <a href="billing.php">Billing</a>
        <a href="report.php" class="active">Reports</a>
        <a href="settings.php">Settings</a>
        <a href="../logout.php" class="logout">Logout</a>
    </div>

    <div class="content">
        <h2>Submit Report</h2>
        <!-- submission-->
        <div class="box">
            <form action="../../controllers/reportControl.php" method="post">
                <input type="text" name="heading" placeholder="Report Heading" required>
                <textarea name="description" placeholder="Describe your problem..." required></textarea>
                <button type="submit" name="submitReport">Submit Report</button>
            </form>
        </div>
        <!-- prev report dekhabo -->
        <h2>Your Previous Reports</h2>
        <div class="box">
            <table>
                <tr>
                    <th>Heading</th>
                    <th>Status</th>
                    <th>Admin Reply</th>
                </tr>
                <?php if(count($reports) > 0): ?>
                    <?php foreach($reports as $r): ?>
                        <tr>
                            <td><?= htmlspecialchars($r['heading']) ?></td>
                            <td class="<?= strtolower($r['status']) ?>">
                                <?= $r['status'] ?>
                            </td>
                            <td><?= $r['admin_reply'] ?? '-' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align:center;">No reports submitted yet</td>
                    </tr>
                <?php endif; ?>

            </table>
        </div>

    </div>
</div>

</body>
</html>
