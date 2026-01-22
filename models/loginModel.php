<?php
require_once("dbConnect.php");
//user login 
function insertLogin($user_id, $hashedPassword, $role, $status) {
    $conn = dbConnect();

    $query = "INSERT INTO logins (user_id, password, role, status) VALUES ('$user_id', '$hashedPassword', '$role', '$status')";
    $data = mysqli_query($conn, $query);
    if($data){
        return true; 
    } else {
        echo "Error inserting into logins table: " . mysqli_error($conn);
        return false;
    }
}

function authUser($userId, $pass)
{
    $conn = dbConnect();
    $query = "SELECT * FROM logins WHERE user_id='$userId'";
    $data  = mysqli_query($conn, $query);
    $users = false;
    if(mysqli_num_rows($data) > 0)
    {
        while($row = mysqli_fetch_assoc($data))
        {
            if(password_verify($pass, $row['password']))
            {
                $users = $row; 
                break; 
            }
        }
    }
    return $users; 
}


//FORGET 
function checkUserEmail($userId, $email){
    $conn = dbConnect();
    $userId = mysqli_real_escape_string($conn, $userId);
    $email  = mysqli_real_escape_string($conn, $email);
    $query = "SELECT * FROM signup WHERE user_id='$userId' AND email='$email'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1){
        return mysqli_fetch_assoc($result);
    }
    return false;
}

// Update password
function updatePassword($userId, $newPass){
    $conn = dbConnect();
    $userId = mysqli_real_escape_string($conn, $userId);
    $hashedPass = password_hash($newPass, PASSWORD_DEFAULT);
    $query = "UPDATE logins SET password='$hashedPass' WHERE user_id='$userId'";
    if(mysqli_query($conn, $query)){
        return true;
    }
    return false;
}
?>
