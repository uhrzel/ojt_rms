<?php

require_once('../config/Database.class.php');


class Student extends Database
{
    public function getStudent($student_id)
    {
        $sql = "SELECT * FROM tbl_student INNER JOIN tbl_user ON tbl_student.student_id = tbl_user.user_id WHERE tbl_student.student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$student_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
