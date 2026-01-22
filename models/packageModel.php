<?php
require_once(__DIR__ . "/dbConnect.php");

function addPackage($name, $speed, $price, $description, $status="active"){
    $conn = dbConnect();
    $name = mysqli_real_escape_string($conn, $name);
    $speed = mysqli_real_escape_string($conn, $speed);
    $price = mysqli_real_escape_string($conn, $price);
    $description = mysqli_real_escape_string($conn, $description);
    $status = mysqli_real_escape_string($conn, $status);
    $query = "INSERT INTO packages (package_name, speed, price, description, status) VALUES ('$name', '$speed', '$price', '$description', '$status')";
    return mysqli_query($conn, $query);
}
function getAllPackages(){
    $conn = dbConnect();
    $query = "SELECT * FROM packages ORDER BY package_id DESC";
    $result = mysqli_query($conn, $query);
    $packages = [];
    if($result && mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $packages[] = $row;
        }
    }
    return $packages;
}
?>
