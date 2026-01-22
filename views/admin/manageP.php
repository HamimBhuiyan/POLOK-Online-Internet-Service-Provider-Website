<?php
require_once(__DIR__ . "/../../controllers/adminControl.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Packages</title>
    <link rel="stylesheet" href="css/aStyle.css">
</head>
<body>

<div class="topbar">
    <span>Hi, <?php echo htmlspecialchars($_SESSION['userId']); ?></span>
    <img src="../css/logo.jpeg" class="logo">
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
        <h2>Add New Package</h2>

        <?php if(isset($message)) echo "<p style='color:green;'>$message</p>"; ?>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <form method="post" action="" style="margin-bottom:30px;">
            <input type="text" name="package_name" placeholder="Package Name" required><br><br>
            <input type="text" name="speed" placeholder="Speed (Mbps)" required><br><br>
            <input type="number" step="0.01" name="price" placeholder="Price (BDT)" required><br><br>
            <textarea name="description" placeholder="Description" rows="3" required></textarea><br><br>
            <select name="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select><br><br>
            <button type="submit" name="add_package">Add Package</button>
        </form>

        <h2>All Packages</h2>
        <table border="1" width="100%" cellpadding="8">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Speed</th>
                <th>Price</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
            <?php foreach($packages as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['package_id']) ?></td>
                <td><?= htmlspecialchars($p['package_name']) ?></td>
                <td><?= htmlspecialchars($p['speed']) ?></td>
                <td><?= htmlspecialchars($p['price']) ?></td>
                <td><?= htmlspecialchars($p['description']) ?></td>
                <td><?= htmlspecialchars($p['status']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

    </div>
</div>

</body>
</html>
