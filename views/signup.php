<?php include '../controllers/signupControl.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup Form</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
<div class="signup-container">

    <div class="signup-box">
        <div class="logo">
           <a href="landing.php"><img src="css/logo.jpeg" alt="Logo"></a> 
        </div>
        <h2>Signup Form</h2>
        <?php if($message != "") { ?>
            <div class="message"><?php echo $message; ?></div>
        <?php } ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" placeholder="Full Name" class="input-field" value="<?php echo isset($name)?$name:''; ?>">
                </div>
                <div class="col">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" class="input-field" value="<?php echo isset($email)?$email:''; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" placeholder="Age" class="input-field" value="<?php echo isset($age)?$age:''; ?>">
                </div>
                <div class="col gender-options">
                    <label>Gender</label><br>
                    <input type="radio" name="gender" value="Male" <?php if(isset($gender) && $gender=="Male") echo "checked"; ?>> Male
                    <input type="radio" name="gender" value="Female" <?php if(isset($gender) && $gender=="Female") echo "checked"; ?>> Female
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="birthdate">Birthdate</label>
                    <input type="date" name="birthdate" id="birthdate" class="input-field" value="<?php echo isset($birthdate)?$birthdate:''; ?>">
                </div>
                <div class="col">
                    <label for="occupation">Occupation</label>
                    <select name="occupation" id="occupation" class="input-field">
                        <option value="">Select Occupation</option>
                        <option value="Student" <?php if(isset($occupation) && $occupation=="Student") echo "selected"; ?>>Student</option>
                        <option value="Engineer" <?php if(isset($occupation) && $occupation=="Engineer") echo "selected"; ?>>Engineer</option>
                        <option value="Doctor" <?php if(isset($occupation) && $occupation=="Doctor") echo "selected"; ?>>Doctor</option>
                        <option value="Teacher" <?php if(isset($occupation) && $occupation=="Teacher") echo "selected"; ?>>Teacher</option>
                        <option value="Other" <?php if(isset($occupation) && $occupation=="Other") echo "selected"; ?>>Other</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" placeholder="Address" class="input-field" value="<?php echo isset($address)?$address:''; ?>">
            </div>
            <div class="row">
                <div class="col">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="input-field">
                </div>
                <div class="col">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="input-field">
                </div>
            </div>
            <div class="row">
                <label for="profile_image">Profile Picture</label>
                <input type="file" name="profile_image" id="profile_image" accept="image/*" class="input-field">
            </div>

            <button type="submit" name="signup" class="btn">Signup</button>

            <p>Already have an Account ? <a href="login.php">Login Now</a></p>
        </form>

    </div>

</div>

</body>
</html>
