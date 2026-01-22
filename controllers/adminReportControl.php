<?php
session_start();
require_once(__DIR__ . '/../models/reportModel.php');

if(!isset($_SESSION['role']) || $_SESSION['role'] != 1 || $_SESSION['status'] != "active"){
    header("Location: ../login.php");
    exit();
}

/* report update admin side theke */
if(isset($_POST['updateStatus'])){
    $reportId = $_POST['report_id'];
    $status   = $_POST['status'];
    $reply = isset($_POST['reply']) ? $_POST['reply'] : '';

    updateReportStatus($reportId, $status, $reply);

    header("Location: ../views/admin/report.php");
    exit();
}
?>
