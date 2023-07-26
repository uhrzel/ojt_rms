<?php

session_start();

require_once('../../config/Database.class.php');

class Login extends Database{
    public function login($email, $password){
        if(empty($email) || empty($password)){
            $_SESSION['error'] = "All fields are required";
        }else{
            $sql = "SELECT * FROM tbl_user WHERE user_email = ? AND user_password = ? AND user_role = 'Admin'";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$email, $password]);
            $result = $stmt->fetch();

            if($result){
                $_SESSION['admin_id'] = $result['user_id'];
                $_SESSION['success'] = "Welcome Admin";
                header('refresh:1; url=../index.php');
            } else {
                $_SESSION['error'] = "Invalid email or password";
            }
        }
    }
}