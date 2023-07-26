<?php

require_once('phpmailer/PHPMailerAutoload.php');

class Database
{
    protected $hostname = "localhost";
    protected $username = "root";
    protected $password = "arzelzolina10";
    protected $database = "ojt_rms_system";
    protected $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->hostname;dbname=$this->database", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function SendMail($to, $from, $subject, $body)
    {
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        $mail->Username = 'capstone.group.5.13@gmail.com';
        $mail->Password = 'lijkxjjpuoivypjk';

        $mail->setFrom('capstone.group.5.13@gmail.com', $from);
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }
}
