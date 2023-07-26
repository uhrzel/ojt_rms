<?php
// error_reporting(0);

require_once('Coordinator.class.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];

    if(empty($email)){
        $_SESSION['error'] = "Email is required";
        header('location:forgot_password.php');
    }else{
        $coordinator = new Coordinator;
        $result = $coordinator->getCoordinatorByEmail($email);
        
        if($result == true){
            $_SESSION['success'] = "Successful";
            $_SESSION['verify'] = true;
            $_SESSION['user_id'] = $result['user_id'];
            header('location:verify.php');
        }else{
            header('location:forgot_password.php');
        }
    }
}