<?php
require_once("dbConnect.php");


function checkUserIdExists($user_id) {
    $conn = dbConnect();
    $query = "SELECT user_id FROM signup WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

// random id generate kori 
function generateUserId(){
    do {
        $user_id = "C-" . rand(10,99);
    } while(checkUserIdExists($user_id));
    return $user_id;
}


function insertUser($user_id, $name, $address, $age, $gender, $email, $birthdate, $occupation, $hashedPassword, $profilePic) {
    $conn = dbConnect();
    $query = "INSERT INTO signup (user_id, name, address, age, gender, email, birthdate, occupation, password, profile_pic) VALUES ('$user_id', '$name', '$address', $age, '$gender', '$email', '$birthdate', '$occupation', '$hashedPassword', '$profilePic')";
    $data = mysqli_query($conn, $query);
    if($data){
        return true;
    } else {
        echo "Error: ".mysqli_error($conn);
        return false;
    }
}

?>
