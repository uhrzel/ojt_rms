<?php

require_once('classes/API_AutoLoader.php');

$get_otp = new OTPVerify();

$otp_code = $_GET['otp'];
$email = $_GET['email'];

// $email = 'ortegacanillo76@gmail.com';
// $otp_code = '374716';

$result = $get_otp->verify($otp_code, $email);

if($result == 'Please fill in all fields'){
    echo $result;
}elseif($result == 'Incorrect OTP'){
    echo $result;
}else{
    echo $result;
}