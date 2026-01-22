<?php
session_start();
require_once("../models/loginModel.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $hasError = false;
    $idErr    = "";
    $passErr  = "";
    $genErr   = "";

    $userId   = isset($_POST["userId"]) ? trim($_POST["userId"]) : "";
    $pass     = isset($_POST["pass"]) ? trim($_POST["pass"]) : "";
    $remember = isset($_POST["remember_me"]);
    if (empty($userId)) {
        $hasError = true;
        $idErr = "User ID cannot be empty";
    }
    if (empty($pass)) {
        $hasError = true;
        $passErr = "Password cannot be empty";
    }
    if ($hasError) {
        header("Location: ../views/login.php?idErr=".$idErr."&passErr=".$passErr);
        exit();
    }

    $user = authUser($userId, $pass); 
    if ($user) {
        if ($user["status"] !== "active") {
            $genErr = "Your account is suspended. Please contact polokOnline@gmail.com.";
            header("Location: ../views/login.php?genErr=".$genErr);
            exit();
        }
        $_SESSION['userId'] = $user['user_id'];
        $_SESSION['role']   = $user['role'];
        $_SESSION['status'] = $user['status'];
        $_SESSION['pass'] = $user['password'];

        //cookie remember me kori
        if ($remember) {
            setcookie("remember_userId", $userId, time() + 3*24*60*60, "/");
            setcookie("remember_pass", $pass, time() + 3*24*60*60, "/");
        } else {
            setcookie("remember_userId", "", time() - 3600, "/");
            setcookie("remember_pass", "", time() - 3600, "/");
        }

        if ($user["role"] == 1 && $user["status"] == "active") {
            header("Location: ../views/admin/aHome.php");
            exit();
        } 
        else if ($user["role"] == 2 && $user["status"] == "active") {
            header("Location: ../views/supporter/sHome.php");
            exit();
        } 
        else if ($user["role"] == 3 && $user["status"] == "active") {
            header("Location: ../views/customer/cHome.php");
            exit();
        } 
        else {
            $genErr = "Invalid role. Contact admin.";
            header("Location: ../views/login.php?genErr=".$genErr);
            exit();
        }
    } else {
        $genErr = "Invalid User ID or password. Please try again.";
        header("Location: ../views/login.php?genErr=".$genErr);
        exit();
    }
}
?>
