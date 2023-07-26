<?php
session_start();
require_once('../../config/Database.class.php');

class Otp extends Database{
    public function sendOtp($email){
        $otp = rand(100000, 999999);
        $sql = "INSERT INTO tbl_otp (otp_code, email) VALUES (?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$otp, $email]);

        $to = $email;
        $from = 'Admin';
        $subject = 'OTP';
        $body = 'Your OTP is: '.$otp;

        $this->SendMail($to, $from, $subject, $body);

        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;
        header('Location: verify.php');
    }

    public function verifyOtp($otp, $user_id){
        $sql = "SELECT * FROM tbl_otp WHERE user_id = ? AND otp_code = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$user_id, $otp]);
        $result = $stmt->fetch();
        return $result;
    }

    public function resetPassword($email, $password){
        $sql = "UPDATE tbl_user SET user_password = ? WHERE user_email = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$password, $email]);

        $_SESSION['success'] = 'Password reset successfully.';
        header('Location: login.php');
    }
}