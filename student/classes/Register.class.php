<?php

require_once('../config/Database.class.php');

class Register extends Database
{
    public function register($email, $password, $user_status, $user_role, $student_id_number, $first_name, $last_name, $contact_number, $course_id, $address, $school_year, $organization_id, $start_date, $required_hours)
    {
        if (empty($email) || empty($password) || empty($user_status) || empty($user_role) || empty($student_id_number) || empty($first_name) || empty($last_name) || empty($contact_number) || empty($course_id) || empty($address) || empty($school_year) || empty($organization_id) || empty($start_date) || empty($required_hours)) {
            return 'All fields are required';
        } else {
            $sql = "SELECT * FROM tbl_user WHERE user_email = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$email]);
            $result_email = $stmt->fetch();

            $sql = "SELECT * FROM tbl_student WHERE student_id_number = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$student_id_number]);
            $result_student_id_number = $stmt->fetch();

            if ($result_email > 0 || $result_student_id_number > 0) {
                return 'Email or Student ID Number already exists';
            } else {
                $otp = rand(100000, 999999);

                $sql = "INSERT INTO tbl_user (user_email, user_password, user_status, user_role) VALUES (?, ?, ?, ?)";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([
                    $email,
                    password_hash($password, PASSWORD_DEFAULT),
                    $user_status,
                    $user_role
                ]);

                $user_id = $this->connection->lastInsertId();

                $sql = "INSERT INTO tbl_student (student_id, student_id_number, first_name, last_name, course_id, contact_number, address, school_year, organization_id, start_date, required_hours) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([
                    $user_id,
                    $student_id_number,
                    $first_name,
                    $last_name,
                    $course_id,
                    $contact_number,
                    $address,
                    $school_year,
                    $organization_id,
                    $start_date,
                    $required_hours
                ]);


                $sql = "INSERT INTO tbl_otp (user_id, otp_code) VALUES (?, ?)";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([
                    $user_id,
                    $otp
                ]);

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
                        Hello, ' . $first_name . ' ' . $last_name . '!
                        </p>
                        <p>
                        Your account has been created. Please verify your account by entering the following OTP:
                        </p>
                        <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
                        ' . $otp . '
                        </h2>
                        <p style="font-size:0.9em;">Regards,<br />
                        OJT RMS
                        </p><br /><br />
                        <p style="font-size:0.9em;">This is a system generated email. Please do not reply.</p>
                        <a href="mailto:Arzeljrz17@gmail.com@gmail.com">
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

                $this->SendMail($email, $from, $subject, $body);

                return 'Account created successfully. Please check your email for verification.';
            }
        }
    }
}
