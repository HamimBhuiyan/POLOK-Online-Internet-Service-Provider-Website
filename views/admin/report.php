<?php
session_start();
require_once(__DIR__ . '/../../models/reportModel.php');

if(!isset($_SESSION['role']) || $_SESSION['role'] != 1 || $_SESSION['status'] != "active"){
    header("Location: ../login.php");
    exit();
}

$reports = getAllReports(); //report shob fetch 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Reports</title>
    <link rel="stylesheet" href="css/aStyle.css">
    
</head>
<body>

<div class="topbar">
    <span>Hi, <?= htmlspecialchars($_SESSION['userId']) ?></span>
    <img src="../css/logo.jpeg" class="logo">
</div>

<div class="dashboard">
    
    <div class="sidebar">
        <h3>Dashboard</h3>
        <hr>
        <a href="aHome.php">Home</a>
        <a href="manageA.php">Manage Accounts</a>
        <a href="manageP.php">Manage Packages</a>
        <a href="revenue.php">Revenue</a>
        <a href="settings.php">Settings</a>
        <a href="../logout.php" class="logout">Logout</a>
    </div>
    <!-- content suru-->
    <div class="content">
        <h2>User Reports</h2>
        <div class="box">
            <table>
                <tr>
                    <th>User ID</th>
                    <th>Heading</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php if(count($reports) > 0): ?>
                    <?php foreach($reports as $r): ?>
                        <tr>
                            <td><?= htmlspecialchars($r['user_id']) ?></td>
                            <td><?= htmlspecialchars($r['heading']) ?></td>
                            <td><?= htmlspecialchars($r['description']) ?></td>

                            <td class="<?= strtolower($r['status']) ?>">
                                <?= $r['status'] ?>
                            </td>
                            <td>
                                <form action="../../controllers/adminReportControl.php" method="post">
                                    <input type="hidden" name="report_id" value="<?= $r['report_id'] ?>">
                                    <select name="status">
                                        <option value="Pending" <?= $r['status']=="Pending"?"selected":"" ?>>Pending</option>
                                        <option value="Solved" <?= $r['status']=="Solved"?"selected":"" ?>>Solved</option>
                                        <option value="Declined" <?= $r['status']=="Declined"?"selected":"" ?>>Declined</option>
                                    </select>
                                     <textarea name="reply" placeholder="Admin reply (optional)"><?= htmlspecialchars($r['admin_reply'] ?? '') ?></textarea><br>
                                    <button type="submit" name="updateStatus">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">No reports found</td>
                    </tr>
                <?php endif; ?>

            </table>
        </div>

    </div>
</div>

</body>
</html>
