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
    <title>Customer Profile</title>
    <link rel="stylesheet" href="css/cStyle.css">
</head>
<body>

<div class="topbar">
    <span>Hi, <?=htmlspecialchars($_SESSION['userId'])?></span>
    <img src="../css/logo.jpeg" alt="Polok Online" class="logo">
</div>

<div class="dashboard">

    <div class="sidebar">
        <h3>Dashboard</h3>
        <hr>
        <a href="cHome.php">Home</a>
        <a href="package.php">Packages</a>
        <a href="internetSpeed.php">Internet Speed</a>
        <a href="report.php">Report</a>
        <a href="billing.php">Billing</a>
        <a href="settings.php">Settings</a>
        <a href="../logout.php" class="logout">Logout</a>
    </div>

    <div class="content">
        <h2>Your Profile</h2>
        <?php if($userInfo): ?>
            <div class="profile-container">
                <div class="profile-item">
                    <strong>User ID:</strong> <?=htmlspecialchars($userInfo['user_id'])?>
                </div>
                <div class="profile-item">
                    <strong>Profile Picture:</strong>
                    <?php if(!empty($userInfo['profile_pic'])): ?>
                        <img src="../../uploads/<?=htmlspecialchars($userInfo['profile_pic'])?>" alt="Profile Pic" class="profile-pic">
                    <?php else: ?>
                        <span>No picture uploaded</span>
                    <?php endif; ?>
                </div>
                <div class="profile-item">
                    <strong>Name:</strong> <?=htmlspecialchars($userInfo['name'])?>
                </div>
                <div class="profile-item">
                    <strong>Address:</strong> <?=htmlspecialchars($userInfo['address'])?>
                </div>

                <div class="profile-item">
                    <strong>Age:</strong> <?=htmlspecialchars($userInfo['age'])?>
                </div>
                <div class="profile-item">
                    <strong>Gender:</strong> <?=htmlspecialchars($userInfo['gender'])?>
                </div>
                <div class="profile-item">
                    <strong>Birthdate:</strong> <?=htmlspecialchars($userInfo['birthdate'])?>
                </div>
                <div class="profile-item">
                    <strong>Occupation:</strong> <?=htmlspecialchars($userInfo['occupation'])?>
                </div>
            </div>

        
            <button id="editBtn" style="margin-top:15px;">Edit Profile</button>
            <!-- hiddden thakbe form-->
            <div id="editForm" style="display:none; margin-top:20px;">
                <form method="post" enctype="multipart/form-data">
                    <input type="text" name="name" value="<?=htmlspecialchars($userInfo['name'])?>" required><br>
                    <input type="text" name="address" value="<?=htmlspecialchars($userInfo['address'])?>" required><br>
                    <input type="number" name="age" value="<?=htmlspecialchars($userInfo['age'])?>" required><br>
                    <select name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male" <?= $userInfo['gender']=="Male"?"selected":"" ?>>Male</option>
                        <option value="Female" <?= $userInfo['gender']=="Female"?"selected":"" ?>>Female</option>
                    </select><br>
                    <input type="date" name="birthdate" value="<?=htmlspecialchars($userInfo['birthdate'])?>" required><br>
                    <input type="text" name="occupation" value="<?=htmlspecialchars($userInfo['occupation'])?>" required><br>
                    <button type="submit" name="update_profile">Update Profile</button>
                </form>
            </div>
        <?php else: ?>
            <p>User info not found in signup table.</p>
        <?php endif; ?>
    </div>
</div>


<script>
//button
document.getElementById('editBtn').addEventListener('click', function(){
    var form = document.getElementById('editForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
});
</script>

</body>
</html>
