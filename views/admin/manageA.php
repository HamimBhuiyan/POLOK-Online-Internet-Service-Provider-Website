<?php
require_once(__DIR__ . "/../../controllers/adminControl.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Accounts</title>
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
        <h2>Customer Accounts</h2>
        <table border="1" width="100%" cellpadding="8">
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Birthdate</th>
                <th>Occupation</th>
            </tr>

            <?php foreach($customers as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c['user_id']) ?></td>
                <td><?= htmlspecialchars($c['name']) ?></td>
                <td><?= htmlspecialchars($c['address']) ?></td>
                <td><?= htmlspecialchars($c['age']) ?></td>
                <td><?= htmlspecialchars($c['gender']) ?></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
                <td><?= htmlspecialchars($c['birthdate']) ?></td>
                <td><?= htmlspecialchars($c['occupation']) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <br><hr><br>

        <h3>Delete Customer</h3>
        <form method="post" action="../../controllers/adminControl.php">
            <input type="text" name="user_id" placeholder="Enter Customer ID (C-00)" required>
            <button type="submit" name="delete">Delete</button>
        </form>
    </div>

</div>



</body>
</html>
