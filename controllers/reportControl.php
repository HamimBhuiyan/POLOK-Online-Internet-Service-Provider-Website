<?php
session_start();
require_once('../models/reportModel.php');

// customer submit
if(isset($_POST['submitReport'])){
    insertReport(
        $_SESSION['userId'],
        $_POST['heading'],
        $_POST['description']
    );
    header("Location: ../views/customer/report.php");
}