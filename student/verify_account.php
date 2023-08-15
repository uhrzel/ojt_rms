<?php

require_once('../config/Database.class.php');
require_once('../student/classes/OTPVerify.class.php');

// Create an instance of OTPVerify
$otpVerifier = new OTPVerify();

// Assuming you're receiving OTP and email from the Flutter app
if (isset($_POST['otp']) && isset($_POST['email'])) {
    $otp = $_POST['otp'];
    $email = $_POST['email'];

    // Call the verify method
    $verificationResult = $otpVerifier->verify($otp, $email);

    // Return the result as JSON
    echo json_encode($verificationResult);
} else {
    echo json_encode(['error' => 'Missing parameters']);
}
