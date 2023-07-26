<?php

require_once('../config/Database.class.php');

class Course extends Database{
    public function getAllCourses(){
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

    public function createCourse($course_code, $course_name){
        $sql = "INSERT INTO tbl_course (course_code, course_name) VALUES (?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$course_code, $course_name]);

        $_SESSION['success'] = 'Course successfully created.';
        header('Location: courses.php');
    }

    public function updateCourse($id, $course_code, $course_name){
        $sql = "UPDATE tbl_course SET course_code = ?, course_name = ? WHERE course_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$course_code, $course_name, $id]);

        $_SESSION['success'] = 'Course successfully updated.';
        header('Location: course.php?course_id='.$id);
    }

    public function deleteCourse($id){
        $sql = "DELETE FROM tbl_course WHERE course_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);

        $_SESSION['success'] = 'Course successfully deleted.';
        header('Location: courses.php');
    }
}