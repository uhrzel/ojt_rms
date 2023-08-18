<?php

require_once('classes/API_AutoLoader.php');

$change_password = new OTPVerify();

$user_id = $_POST['user_id'];
$password = $_POST['password'];

$result = $change_password->changePassword($user_id, $password);

if ($result == 'Please fill in all fields') {
    echo $result;
} else {
    echo $result;
}
