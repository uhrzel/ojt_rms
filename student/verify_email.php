<?php

require_once('classes/API_AutoLoader.php');


$email = $_GET['email'];

$get_email = new OTPVerify();
// $email = 'ortegacanillo76@gmail.com';

$result = $get_email->verifyEmail($email);

if($result == 'Email is required'){
    echo $result;
}elseif($result == 'Email not found'){
    echo $result;
}else{
    echo $result;
}