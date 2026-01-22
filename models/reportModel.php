<?php
require_once('dbConnect.php');

function insertReport($userId, $heading, $desc){
    $conn = dbConnect();
    $userId = mysqli_real_escape_string($conn, $userId);
    $heading = mysqli_real_escape_string($conn, $heading);
    $desc = mysqli_real_escape_string($conn, $desc);
    $sql = "INSERT INTO reports (user_id, heading, description, status, admin_reply) VALUES ('$userId', '$heading', '$desc', 'Pending', NULL)";
    return mysqli_query($conn, $sql);
}

//customer fetch
function getReportsByUser($userId){
    $conn = dbConnect();
    $userId = mysqli_real_escape_string($conn, $userId);

    $sql = "SELECT * FROM reports WHERE user_id='$userId' ORDER BY report_id DESC";
    $res = mysqli_query($conn, $sql);
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}
// same 2ta 
function getAllReports() {
    $conn = dbConnect();
    $query= "SELECT * FROM reports";
    $res = mysqli_query($conn,$query);
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

function updateReportStatus($id, $status, $reply){
    $conn = dbConnect();
    $id = intval($id); 
    $status = mysqli_real_escape_string($conn, $status);
    $reply = mysqli_real_escape_string($conn, $reply);

    $sql = "UPDATE reports SET status='$status', admin_reply='$reply' WHERE report_id=$id";
    return mysqli_query($conn, $sql);
}
?>
