<?php

require_once('../config/Database.class.php');

class Course extends Database{
    public function getCourses(){
        $sql = "SELECT * FROM tbl_course ORDER BY course_id DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getCourse($id){
        $sql = "SELECT * FROM tbl_course WHERE course_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function getCourseByCourseCode($course_code){
        $sql = "SELECT * FROM tbl_course WHERE course_code = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$course_code]);
        $result = $stmt->fetch();
        return $result;
    }
}