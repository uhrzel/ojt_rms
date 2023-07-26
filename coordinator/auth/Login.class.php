<?php

session_start();

require_once('../../config/Database.class.php');

class Login extends Database{
    public function login($email, $password){
        if(empty($email) || empty($password)){
            $_SESSION['error'] = "All fields are required";
        }else{
            $sql = "SELECT * FROM tbl_user WHERE user_email = ? AND user_role = 'Coordinator'";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$email]);
            $result = $stmt->fetch();

            if($result){
                
                if($result['isVerified'] == 1){
                
                    if(password_verify($password, $result['user_password'])){
                        if($result['user_status'] == 'Verified'){
                            $_SESSION['coordinator_id'] = $result['user_id'];
                            $_SESSION['success'] = "Welcome Coordinator";
                            header('refresh:1; url=../index.php');
                        }else{
                            $_SESSION['coordinator_id_verify'] = $result['user_id'];
                            $_SESSION['success'] = "Please Change your password";
                            $_SESSION['change_password'] = true;
                            $_SESSION['coordinator_id'] = $result['user_id'];
                            header('refresh:1; url=../auth/change_password.php');
                        }
                    }else{
                        $_SESSION['error'] = "Incorrect password";
                    }
                
                }else{
                    $_SESSION['error'] = "Your Account is not Verified";
                }
            } else {
                $_SESSION['error'] = "Incorrect email";
            }
        }
    }

    public function changePassword($password, $coordinator_id){
        $sql = "UPDATE tbl_user SET user_password = ?, user_status = 'Verified' WHERE user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([password_hash($password, PASSWORD_DEFAULT), $coordinator_id]);

        $sql = "DELETE FROM tbl_otp WHERE user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$coordinator_id]);

        $_SESSION['success'] = "Password changed successfully";
        unset($_SESSION['coordinator_id']);
        header('refresh:1; url=signin.php');
    }
}