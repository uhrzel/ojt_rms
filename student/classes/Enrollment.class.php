<?php

require_once('../../classes/Database.class.php');


class Enrollment extends Database{
    public function getEnrollment($id) {
        $sql = "SELECT * FROM tbl_enrollment WHERE student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }
}