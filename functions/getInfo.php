<?php

$userInfo = $connectDB->getUserInfo($userID);
if (is_array($userInfo)) {
    $username = $userInfo['username'];
    $name = $userInfo['first_name']. " " .$userInfo['last_name'];
    $dob = $userInfo['dob'];
    $gender = $userInfo['gender'];
    $email = $userInfo['email'];
    $password = $userInfo['password'];
    $profile_picture = $userInfo['profile_picture'];
    $college = $userInfo['college_name'];
    $schoolID = $userInfo['school_id'];
} else {
  echo $userInfo;
}

?>