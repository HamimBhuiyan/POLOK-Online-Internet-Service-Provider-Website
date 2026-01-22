<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/../models/customerModel.php'); 
require_once(__DIR__ . '/../models/customerModel.php'); 

if(!isset($_SESSION['userId']) || $_SESSION['role'] != 3 || $_SESSION['status'] != "active"){
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['userId'];

$userInfo = getCustomerInfo($userId); 


// Ajax search request
if(isset($_GET['ajax']) && isset($_GET['query'])){
    $searchTerm = trim($_GET['query']);
    $packages = searchPackages($searchTerm);

    foreach($packages as $p){
        echo "<tr>
            <td>".htmlspecialchars($p['package_id'])."</td>
            <td>".htmlspecialchars($p['package_name'])."</td>
            <td>".htmlspecialchars($p['speed'])."</td>
            <td>".htmlspecialchars($p['price'])."</td>
            <td>".htmlspecialchars($p['description'])."</td>
        </tr>";
    }
    exit();
}

$packages = getAllPackages();

//edit profile 
$userId = $_SESSION['userId'];
$userInfo = getCustomerInfo($userId);

if(isset($_POST['update_profile'])){
    $name       = trim($_POST['name']);
    $address    = trim($_POST['address']);
    $age        = trim($_POST['age']);
    $gender     = trim($_POST['gender']);
    $birthdate  = trim($_POST['birthdate']);
    $occupation = trim($_POST['occupation']);

    

    $updated = updateCustomerProfile($userId, $name, $address, $age, $gender, $birthdate, $occupation);
    if($updated){
        $userInfo = getCustomerInfo($userId);
        $message = "Profile updated successfully!";
    } else {
        $error = "Profile update failed!";
    }
}
?>
