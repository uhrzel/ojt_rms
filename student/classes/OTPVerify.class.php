<?php
require_once('../config/Database.class.php');
class OTPVerify extends Database
{
    public function verify($otp, $email)
    {
        if (empty($otp) || empty($email)) {
            return 'Please fill in all fields';
        } else {
            $sql = "SELECT * FROM tbl_user INNER JOIN tbl_student ON tbl_user.user_id = tbl_student.student_id INNER JOIN tbl_otp ON tbl_user.user_id = tbl_otp.user_id WHERE tbl_user.user_email = ? AND tbl_otp.otp_code = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$email, $otp]);
            $result = $stmt->fetch();

            if ($result) {
                $sql = "UPDATE tbl_user SET user_status = ? WHERE user_id = ?";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute(['Verified', $result['user_id']]);

                $sql = "DELETE FROM tbl_otp WHERE user_id = :user_id";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([':user_id' => $result['user_id']]);

                // Add the following code to update the isVerified column
                $sql = "UPDATE tbl_student SET isVerified = ? WHERE student_id = ?";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute(['1', $result['student_id']]);

                return $result['user_id'];
            } else {
                return 'Incorrect OTP';
            }
        }
    }


    public function verifyEmail($email)
    {
        if (empty($email)) {
            return 'Email is required';
        } else {
            $sql = "SELECT u.*, s.first_name, s.last_name 
        FROM tbl_user u
        JOIN tbl_student s ON u.user_id = s.student_id
        WHERE u.user_email = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$email]);
            $result = $stmt->fetch();



            if ($result) {
                $otp = rand(100000, 999999);
                $sql = "INSERT INTO tbl_otp (user_id, otp_code) VALUES (?, ?)";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$result['user_id'], $otp]);

                $from = 'OJT RMS';
                $subject = 'OJT RMS - Account Verification';
                $body = '
                <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
                    <div style="margin:50px auto;width:70%;padding:20px 0">
                        <div style="border-bottom:1px solid #eee">
                            <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">
                            ' . $subject . '
                            </a>
                        </div>
                        <p style="font-size:1.1em">
                        Hello, ' . $result['first_name'] . ' ' . $result['last_name'] . '
                        </p>
                        <p>
                        Your account verification code is: <b>' . $otp . '</b>
                        </p>
                        <p style="font-size:0.9em;">Regards,<br />
                        OJT RMS
                        </p><br /><br />
                        <p style="font-size:0.9em;">This is a system generated email. Please do not reply.</p>
                        <hr style="border:none;border-top:1px solid #eee" />
                        <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
                            <p>
                            OJT RMS
                            </p>
                            <p>
                            6038, Toledo City, Cebu
                            </p>
                            <p>
                            Philippines
                            </p>
                        </div>
                    </div>
                </div>
                ';

                $this->SendMail($email, $from, $subject, $body);

                return $result['user_id'];
            } else {

                return 'Email not found';
            }
        }
    }

    public function changePassword($user_id, $password)
    {
        if (empty($user_id) || empty($password)) {
            return 'Please fill in all fields';
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE tbl_user SET user_password = ? WHERE user_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$password, $user_id]);

            return 'Password changed';
        }
    }
}
