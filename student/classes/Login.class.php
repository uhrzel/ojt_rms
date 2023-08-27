<?php

require_once('../config/Database.class.php');

class Login extends Database
{
    public function login($email, $password)
    {
        if (empty($email) || empty($password)) {
            return 'Please fill in all fields';
        } else {
            $sql = "SELECT * FROM tbl_user INNER JOIN tbl_student ON tbl_user.user_id = tbl_student.student_id WHERE user_email = ? AND user_role = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$email, 'Student']);
            $result = $stmt->fetch();

            if ($result) {
                if (password_verify($password, $result['user_password'])) {
                    if ($result['user_status'] == 'Verified') {

                        if ($result['isVerified'] == 1) {

                            $device_name = $_SERVER['HTTP_USER_AGENT'];
                            $ip_address = $_SERVER['REMOTE_ADDR'];

                            $date_time = date('Y-m-d H:i:s');
                            $from = 'OJT RMS - Login alert';
                            $subject = 'Login alert';
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
                                    You have successfully logged in to your account.
                                    </p>
                                    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
                                    Device: ' . $device_name . '
                                    </h2>
                                    <br />
                                    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
                                    IP Address: ' . $ip_address . '
                                    </h2>
                                    <br />
                                    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
                                    Date and Time: ' . $date_time . '
                                    </h2>
                                    <p style="font-size:0.9em;">Regards,<br />
                                    OJT RMS
                                    </p><br /><br />
                                    <p style="font-size:0.9em;">This is a system generated email. Please do not reply.</p>
                                    <a href="mailto:Arzeljrz17@gmail.com">
                                    Here
                                    </a>
                                    <hr style="border:none;border-top:1px solid #eee" />
                                    <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
                                        <p>
                                        OJT RMS
                                        </p>
                                        <p>
                                        9504, Polomolok South Cotabato
                                        </p>
                                        <p>
                                        Philippines
                                        </p>
                                    </div>
                                </div>
                            </div>
                            ';

                            $this->SendMail($result['user_email'], $from, $subject, $body);

                            return $result['user_id'];
                        } else {
                            return 'Account needs to verify to login';
                        }
                    } else {
                        return 'Account not verified';
                    }
                } else {
                    return 'Incorrect password';
                }
            } else {
                return 'Email not found';
            }
        }
    }
}
