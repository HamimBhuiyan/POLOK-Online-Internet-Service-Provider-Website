<?php
require_once(__DIR__ . '/../../controllers/customerControl.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Packages</title>
    <link rel="stylesheet" href="css/cStyle.css">
    
</head>
<body>
<div class="topbar">
    <span>Hi, <?= htmlspecialchars($_SESSION['userId']); ?></span>
    <img src="../css/logo.jpeg" alt="Polok Online" class="logo">
</div>

<div class="dashboard">
    <div class="sidebar">
        <h3>Dashboard</h3>
        <hr>
        <a href="cHome.php">Home</a>
        <a href="profile.php">Profile</a>
        <a href="internetSpeed.php">Internet Speed</a>
        <a href="report.php">Report</a>
        <a href="billing.php">Billing</a>
        <a href="settings.php">Settings</a>
        <a href="../logout.php" class="logout">Logout</a>
    </div>

    <div class="content">
        <h2>Available Packages</h2>
        <input type="text" id="package-search" placeholder="Search Packages..." style="width:100%; padding:8px; margin-bottom:20px;">>
        <table border="1" width="100%" cellpadding="8" id="packages-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Speed</th>
                    <th>Price</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($packages as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['package_id']) ?></td>
                    <td><?= htmlspecialchars($p['package_name']) ?></td>
                    <td><?= htmlspecialchars($p['speed']) ?></td>
                    <td><?= htmlspecialchars($p['price']) ?></td>
                    <td><?= htmlspecialchars($p['description']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<script>
function searchPackages() {
    let query = document.getElementById('package-search').value.trim();
    let tableBody = document.querySelector('#packages-table tbody');

    if(query.length === 0) {
        // Input empty → reset table
        tableBody.innerHTML = "";
        <?php foreach($packages as $p): ?>
            tableBody.innerHTML += `<tr>
                <td><?= htmlspecialchars($p['package_id']) ?></td>
                <td><?= htmlspecialchars($p['package_name']) ?></td>
                <td><?= htmlspecialchars($p['speed']) ?></td>
                <td><?= htmlspecialchars($p['price']) ?></td>
                <td><?= htmlspecialchars($p['description']) ?></td>
            </tr>`;
        <?php endforeach; ?>
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "../../controllers/customerControl.php?ajax=1&query=" + encodeURIComponent(query), true);

    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            tableBody.innerHTML = xhr.responseText;
        }
    }

    xhr.send();
}

// Attach event listener
document.getElementById('package-search').addEventListener('keyup', searchPackages);
</script>

</body>
</html>
