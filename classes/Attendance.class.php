<?php

require_once('../config/Database.class.php');

class Attendance extends Database{
    public function getAttendances(){
        $sql = "SELECT * FROM tbl_attendance";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getStudentAttendance($student_id){
        $sql = "SELECT * FROM tbl_attendance WHERE student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$student_id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getTotalTrainingHours($student_id){
        $sql = "SELECT SUM(TIME_TO_SEC(TIMEDIFF(attendance_time_out, attendance_time_in))) AS total_training_hours FROM tbl_attendance WHERE student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$student_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_training_hours = $result['total_training_hours'] / 3600;
        $total_training_hours = number_format($total_training_hours, 0, '.', '');
        return $total_training_hours;
    }

    public function getAttendanceByCoordinator($id){
        $sql = "SELECT * FROM tbl_attendance WHERE coordinator_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll();
        return $result;
    }

     public function getAttendanceByOrganization($id){
        $sql = "SELECT * FROM tbl_attendance INNER JOIN tbl_student ON tbl_attendance.student_id = tbl_student.student_id WHERE tbl_student.organization_id = ? ORDER BY tbl_attendance.attendance_id DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getAttendanceByOrganizationAndStudent($organization_id, $student_id){
        $sql = "SELECT * FROM tbl_attendance WHERE organization_id = ? AND student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$organization_id, $student_id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function createAttendanceTimeIn($student_id, $attendance_date, $attendance_time_in, $attendance_log, $coordinator_id, $organization_id){
        $sql = "INSERT INTO tbl_attendance (student_id, attendance_date, attendance_time_in, attendance_log, coordinator_id, organization_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute([$student_id, $attendance_date, $attendance_time_in, $attendance_log, $coordinator_id, $organization_id]);
        return $result;
    }

    public function createAttendanceTimeOut($attendance_id, $attendance_time_out){
        $sql = "UPDATE tbl_attendance SET attendance_time_out = ? WHERE attendance_id = ?";
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute([$attendance_time_out, $attendance_id]);
        return $result;
    }

    public function deleteAttendance($id){
        $sql = "DELETE FROM tbl_attendance WHERE attendance_id = ?";
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute([$id]);
        if($result){
            $_SESSION['success'] = "Attendance deleted successfully";
            header("Location: ../coordinator/attendance.php");
        }else{
            $_SESSION['error'] = "Something went wrong. Please try again.";
            header("Location: ../coordinator/attendance.php");
        }
    }
}