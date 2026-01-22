<?php

require_once("dbConnect.php"); 

function getCustomerInfo($userId){
    $conn = dbConnect();
    $userId = mysqli_real_escape_string($conn, $userId);
    $query = "SELECT * FROM signup WHERE user_id='$userId' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if($result && mysqli_num_rows($result) > 0){
        return mysqli_fetch_assoc($result);
    }
    return false;
}

//package 
function getAllPackages() {
    $conn = dbConnect();
    $query = "SELECT * FROM packages WHERE status='active' ORDER BY package_id DESC";
    $result = mysqli_query($conn, $query);

    $packages = [];
    if($result && mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $packages[] = $row;
        }
    }
    return $packages;
}

// Ajax er jonno 
function searchPackages($searchTerm) {
    $conn = dbConnect();
    $term = mysqli_real_escape_string($conn, $searchTerm);
    $query = "SELECT * FROM packages WHERE status='active' AND package_name LIKE '%$term%' ORDER BY package_id DESC";
    $result = mysqli_query($conn, $query);

    $packages = [];
    if($result && mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $packages[] = $row;
        }
    }
    return $packages;
}

//edit profile 
function updateCustomerProfile($userId, $name, $address, $age, $gender, $birthdate, $occupation){
    $conn = dbConnect();
    $name = mysqli_real_escape_string($conn, $name);
    $address = mysqli_real_escape_string($conn, $address);
    $age = (int)$age;
    $gender = mysqli_real_escape_string($conn, $gender);
    $birthdate = mysqli_real_escape_string($conn, $birthdate);
    $occupation = mysqli_real_escape_string($conn, $occupation);
    $query = "UPDATE signup SET name='$name', address='$address', age='$age', gender='$gender', birthdate='$birthdate', occupation='$occupation' WHERE user_id='$userId'";
    return mysqli_query($conn, $query);
}
?>