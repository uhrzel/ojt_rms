<?php
session_start();
require_once('../../config/Database.class.php');

class Coordinator extends Database{
    public function getCoordinator($id){
        $sql = "SELECT * FROM tbl_coordinator INNER JOIN tbl_user ON tbl_coordinator.coordinator_id = tbl_user.user_id INNER JOIN tbl_organization ON tbl_coordinator.organization_id = tbl_organization.organization_id WHERE tbl_coordinator.coordinator_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function getCoordinatorbyEmail($email){
        $sql = "SELECT * FROM tbl_coordinator INNER JOIN tbl_user ON tbl_coordinator.coordinator_id = tbl_user.user_id INNER JOIN tbl_organization ON tbl_coordinator.organization_id = tbl_organization.organization_id WHERE tbl_user.user_email = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch();

        if($result){
            $otp = rand(100000, 999999);

            $sql = "INSERT INTO tbl_otp (user_id, otp_code) VALUES (?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$result['coordinator_id'], $otp]);

            $from = 'OJT RMS';
            $subject = 'OJT RMS - Coordinator Account (Forgot Password)';
            $body = '
            <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
                <div style="margin:50px auto;width:70%;padding:20px 0">
                    <div style="border-bottom:1px solid #eee">
                        <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">
                        '.$subject.'
                        </a>
                    </div>
                    <p style="font-size:1.1em">
                    Hello, '. $result['first_name'] . ' ' . $result['last_name'] . '!<br />
                    </p>
                    <p>
                    You have requested to reset your password. Please verify your account by entering the OTP below.
                    </p>
                    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
                    '.$otp.'
                    </h2>
                    <p style="font-size:0.9em;">Regards,<br />
                    OJT RMS
                    </p><br /><br />
                    <p style="font-size:0.9em;">This is a system generated email. Please do not reply.</p>
                    <a href="mailto:ortegacanillo76@gmail.com">
                    Here
                    </a>
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

            return $result;
        }else{
            return false;
        }
    }

    public function updateCoordinator($coordinator_id, $email, $first_name, $last_name, $contact_number, $organization_id){
        $sql = "UPDATE tbl_user SET user_email = ? WHERE user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$email, $coordinator_id]);

        $sql = "UPDATE tbl_coordinator SET first_name = ?, last_name = ?, contact_number = ?, organization_id = ? WHERE coordinator_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$first_name, $last_name, $contact_number, $organization_id, $coordinator_id]);

        $_SESSION['success'] = 'Coordinator successfully updated.';
        header('Location: coordinator.php?coordinator_id=' . $coordinator_id);
    }

    public function deleteCoordinator($id){
        $sql = "DELETE FROM tbl_coordinator WHERE coordinator_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);

        $sql = "DELETE FROM tbl_user WHERE user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);

        $_SESSION['success'] = 'Coordinator successfully deleted.';
        header('Location: coordinators.php');
    }
}