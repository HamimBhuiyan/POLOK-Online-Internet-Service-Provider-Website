<?php
require_once(__DIR__ . "/../models/packageModel.php");
require_once(__DIR__ . "/../models/adminModel.php");
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 1 || $_SESSION['status'] != "active"){
    header("Location: ../login.php");
    exit();
}

/* Delete customer */
if(isset($_POST['delete'])){
    deleteCustomer($_POST['user_id']);
    header("Location: ../views/admin/manageA.php");
    exit();
}
$customers = getAllCustomers();

//package create kori 
if(isset($_POST['add_package'])){
    $name = trim($_POST['package_name']);
    $speed = trim($_POST['speed']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $status = isset($_POST['status']) ? trim($_POST['status']) : 'active';

    if($name && $speed && $price && $description){
        $inserted = addPackage($name, $speed, $price, $description, $status);
        if($inserted){
            $message = "Package added successfully!";
        } else {
            $error = "Failed to add package!";
        }
    } else {
        $error = "Please fill all fields!";
    }
}

// packages fetch
$packages = getAllPackages();