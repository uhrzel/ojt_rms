<?php

require_once('classes/API_AutoLoader.php');

$login = new Login();

$email = $_GET['email'];
$password = $_GET['password'];

// $email = 'ortegacanillo76@gmail.com';
// $password = 'asd';

$result = $login->login($email, $password);

if($result == 'Email not found'){
    echo $result;
}elseif($result == 'Incorrect password'){
    echo $result;
}elseif($result == 'Please fill in all fields'){
    echo $result;
}elseif($result == 'Account not verified'){
    echo $result;
}else{
    echo $result;
}