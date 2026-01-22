<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

function dbConnect()
{
    $host = "localhost";
    $user = "root";
    $password = ""; 
    $db_name = "Polok_Online";
    $port = 3306;

    $conn = mysqli_connect($host, $user, $password, $db_name, $port);

    if(!$conn){
    
    }

    return $conn;
}
