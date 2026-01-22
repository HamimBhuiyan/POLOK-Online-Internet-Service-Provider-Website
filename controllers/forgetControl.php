<?php
require_once("../models/loginModel.php");

if(isset($_POST['resetPassword'])){

    $userId      = trim($_POST['userId']);
    $email       = trim($_POST['email']);
    $newPass     = trim($_POST['newPass']);
    $confirmPass = trim($_POST['confirmPass']);

    if(empty($userId) || empty($email) || empty($newPass) || empty($confirmPass)){
        $msg = "All fields are required!";
        header("Location: ../views/forget.php?genErr=".urlencode($msg));
        exit();
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $msg = "Invalid email format!";
        header("Location: ../views/forget.php?genErr=".urlencode($msg));
        exit();
    }
    if($newPass !== $confirmPass){
        $msg = "Passwords do not match!";
        header("Location: ../views/forget.php?genErr=".urlencode($msg));
        exit();
    }
    $user = checkUserEmail($userId, $email);
    if(!$user){
        $msg = "Invalid Identity. Please Provide Correct Information";
        header("Location: ../views/forget.php?genErr=".urlencode($msg));
        exit();
    }
    else{
    $update = updatePassword($userId, $newPass);

    if($update){
        $msg = "Password reset successfully! You can now login.";
        header("Location: ../views/login.php?genErr=".urlencode($msg));
        exit();
    } else {
        $msg = "Failed to reset password. Try again!";
        header("Location: ../views/forget.php?genErr=".urlencode($msg));
        exit();
    }
    }
}
?>
