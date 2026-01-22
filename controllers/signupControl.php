<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../models/userModel.php';
require_once '../models/loginModel.php';

$message = "";
$new_name = ""; 

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name       = isset($_POST['name']) ? trim($_POST['name']) : '';
    $address    = isset($_POST['address']) ? trim($_POST['address']) : '';
    $age        = isset($_POST['age']) ? $_POST['age'] : '';
    $gender     = isset($_POST['gender']) ? $_POST['gender'] : '';
    $email      = isset($_POST['email']) ? trim($_POST['email']) : '';
    $birthdate  = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
    $occupation = isset($_POST['occupation']) ? $_POST['occupation'] : '';
    $password   = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm    = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    $has_error = false;

   if(empty($name)){
    $message = "Name is required!";
    $has_error = true;
} elseif(empty($address)){
    $message = "Address is required!";
    $has_error = true;
} elseif(!is_numeric($age) || $age <= 0){
    $message = "Enter a valid age!";
    $has_error = true;
} elseif(empty($gender)){
    $message = "Please select gender!";
    $has_error = true;
} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $message = "Invalid email!";
    $has_error = true;
} elseif(empty($birthdate)){
    $message = "Birthdate is required!";
    $has_error = true;
} elseif(!$has_error && !empty($birthdate)) {
    $birth_year = (int)date("Y", strtotime($birthdate));
    $current_year = (int)date("Y");
    $calculated_age = $current_year - $birth_year;
    if($calculated_age != (int)$age){
        $message = "Age and birthdate do not match!";
        $has_error = true;
    }
} elseif(strlen($password) < 6){
    $message = "Password must be at least 6 characters!";
    $has_error = true;
} elseif($password !== $confirm){
    $message = "Passwords do not match!";
    $has_error = true;
} elseif(!isset($_FILES['profile_image']) || $_FILES['profile_image']['error'] != 0){
    $message = "Profile image is required!";
    $has_error = true;
}


    if(!$has_error){
        $allowed_ext = ['jpg','jpeg','png'];
        $file_name = $_FILES['profile_image']['name'];
        $file_tmp  = $_FILES['profile_image']['tmp_name'];
        $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $file_size = $_FILES['profile_image']['size'];

        if(!in_array($file_ext, $allowed_ext)){
            $message = "Only JPG, JPEG, PNG allowed!";
            $has_error = true;
        } elseif($file_size > 2*1024*1024){
            $message = "File size must be <= 2MB!";
            $has_error = true;
        } else {
            $upload_dir = "../uploads/";
            if(!is_dir($upload_dir)){
                 mkdir($upload_dir);}

            $new_name = uniqid('profile_').".".$file_ext;
            $upload_path = $upload_dir.$new_name;

            if(!move_uploaded_file($file_tmp, $upload_path)){
                $message = "Error uploading file!";
                $has_error = true;
            }
        }
    }


    if(!$has_error){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user_id = generateUserId();

        $inserted = insertUser($user_id, $name, $address, $age, $gender, $email, $birthdate, $occupation, $hashedPassword, $new_name);

        if($inserted){
            
            $status = "active";
            $role   = 3; 
            $loginInserted = insertLogin($user_id, $hashedPassword,$role, $status );

            if($loginInserted){
                header("Location: ../views/signup.php?success=1&user_id=$user_id");
                exit();
            } else {
                $message = "User created but login info could not be saved!";
            }
        } else {
            $message = "Something went wrong. Try again!";
        }
    }
}

if(isset($_GET['success']) && $_GET['success'] == 1){
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
    if($user_id != ''){
        $message = "Signup successful! Your User ID: $user_id. You can now login.";
    }
}
?>
