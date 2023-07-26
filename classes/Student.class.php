<?php

require_once('../config/Database.class.php');


class Student extends Database{
    public function getAllStudents(){
        $sql = "SELECT * FROM tbl_student INNER JOIN tbl_user ON tbl_student.student_id = tbl_user.user_id INNER JOIN tbl_course ON tbl_student.course_id = tbl_course.course_id INNER JOIN tbl_organization ON tbl_student.organization_id = tbl_organization.organization_id ORDER BY tbl_student.first_name ASC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getStudent($id){
        $sql = "SELECT * FROM tbl_student INNER JOIN tbl_user ON tbl_student.student_id = tbl_user.user_id INNER JOIN tbl_course ON tbl_student.course_id = tbl_course.course_id INNER JOIN tbl_organization ON tbl_student.organization_id = tbl_organization.organization_id WHERE tbl_student.student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function getStudentsByCourse($course_id){
        $sql = "SELECT * FROM tbl_student WHERE course_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$course_id]);
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function getStudentsByOrganization($organization_id){
        $sql = "SELECT * FROM tbl_student INNER JOIN tbl_user ON tbl_student.student_id = tbl_user.user_id INNER JOIN tbl_course ON tbl_student.course_id = tbl_course.course_id INNER JOIN tbl_organization ON tbl_student.organization_id = tbl_organization.organization_id WHERE tbl_student.organization_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$organization_id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function updateStudent($student_id, $email, $student_id_number, $first_name, $last_name, $course_id, $contact_number, $address, $school_year, $organization_id, $start_date, $required_hours){
        if(empty($email) || empty($student_id_number) || empty($first_name) || empty($last_name) || empty($contact_number) || empty($course_id) || empty($address) || empty($school_year) || empty($organization_id) || empty($required_hours)){
            $_SESSION['error'] = 'All fields are required.';
            header('Location: student.php?student_id='.$student_id);
        }else{
            $sql = "UPDATE tbl_user SET user_email = ? WHERE user_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$email, $student_id]);

            $sql = "UPDATE tbl_student SET student_id_number = ?, first_name = ?, last_name = ?, contact_number = ?, course_id = ?, address = ?, school_year = ?, organization_id = ?, start_date = ?, required_hours = ? WHERE student_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$student_id_number, $first_name, $last_name, $contact_number, $course_id, $address, $school_year, $organization_id, $start_date, $required_hours, $student_id]);

            $_SESSION['success'] = 'Student successfully updated.';
            header('Location: student.php?student_id='.$student_id);
        }
    }

    public function deleteStudent($id){
        $sql = "DELETE FROM tbl_student WHERE student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);

        $sql = "DELETE FROM tbl_user WHERE user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);

        $_SESSION['success'] = 'Student successfully deleted.';
        header('Location: students.php');
    }

    public function verifyStudent($id){
        $sql = "UPDATE tbl_user SET isVerified = '1' WHERE user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);

        $_SESSION['success'] = 'Student successfully verified.';
        header('Location: students.php');
    }

    public function unverifyStudent($id){
        $sql = "UPDATE tbl_user SET isVerified = '0' WHERE user_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);

        $_SESSION['success'] = 'Student successfully unverified.';
        header('Location: students.php');
    }
}