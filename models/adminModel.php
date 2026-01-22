<?php
require_once(__DIR__ . "/dbConnect.php");

function getAllCustomers(){
    $conn = dbConnect();
    $query = "SELECT * FROM signup WHERE user_id LIKE 'C-%'";
    $result = mysqli_query($conn, $query);

    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
    return $data;
}

function deleteCustomer($userId){
    $conn = dbConnect();

    $query1 = "DELETE FROM logins WHERE user_id='$userId'";
    $d1 = mysqli_query($conn, $query1);

    $query2 = "DELETE FROM signup WHERE user_id='$userId'";
    $d2 = mysqli_query($conn, $query2);

    if($d1 && $d2){
        return true;
    }
    return false;
}


function getAllReports(){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM reports ORDER BY id DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateReportStatus($reportId, $status, $reply){
    global $conn;
    $stmt = $conn->prepare("UPDATE reports SET status = :status WHERE id = :id");
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $reportId);
    return $stmt->execute();
}
