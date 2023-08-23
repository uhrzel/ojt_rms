<?php

require_once('../config/Database.class.php');


class Attendance extends Database
{
    public function getAttendance($student_id)
    {
        $sql = "SELECT * FROM tbl_attendance WHERE student_id = ? ORDER BY attendance_id DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$student_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getTotalTrainingHours($student_id)
    {
        $sql = "SELECT SUM(TIME_TO_SEC(TIMEDIFF(attendance_time_out, attendance_time_in))) AS total_hours FROM tbl_attendance WHERE student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$student_id]);
        $total_hours = $stmt->fetch(PDO::FETCH_ASSOC);

        // get remaining hours
        $sql = "SELECT * FROM tbl_student WHERE student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$student_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $remaining_hours = $result['required_hours'] - ($total_hours['total_hours'] / 3600);

        // format remaining hours
        $remaining_hours = number_format($remaining_hours, 0, '.', '');
        return $remaining_hours;
    }

    //THIS COULD BE FIX THE GET TOTAL HOURS OF REMAINING HOURS
    /*   public function getTotalTrainingHours($student_id)
    {
        $sql = "SELECT attendance_time_in, attendance_time_out FROM tbl_attendance WHERE student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$student_id]);
        $attendance_records = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $total_seconds = 0;

        foreach ($attendance_records as $record) {
            $time_in = strtotime($record['attendance_time_in']);
            $time_out = strtotime($record['attendance_time_out']);
            $time_difference = $time_out - $time_in;
            $total_seconds += $time_difference;
        }

        $total_hours = $total_seconds / 3600;

        // get remaining hours
        $sql = "SELECT * FROM tbl_student WHERE student_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$student_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $remaining_hours = $result['required_hours'] - $total_hours;

        // format remaining hours
        $remaining_hours = number_format($remaining_hours, 0, '.', '');
        return $remaining_hours;
    }
 */
    public function checkAttendance($student_id, $attendance_date)
    {
        $sql = "SELECT * FROM tbl_attendance WHERE student_id = ? AND attendance_date = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$student_id, $attendance_date]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAttendanceMorning($student_id, $attendance_date, $organization_id)
    {
        $sql = "SELECT * FROM tbl_attendance WHERE student_id = ? AND attendance_date = ? AND attendance_log = 'Morning' AND organization_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$student_id, $attendance_date, $organization_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAttendanceAfternoon($student_id, $attendance_date, $organization_id)
    {
        $sql = "SELECT * FROM tbl_attendance WHERE student_id = ? AND attendance_date = ? AND attendance_log = 'Afternoon' AND organization_id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$student_id, $attendance_date, $organization_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }



    public function AttendanceTimeIn($student_id, $attendance_date, $attendance_time_in, $attendance_log, $coordinator_id, $organization_id)
    {
        $sql = "INSERT INTO tbl_attendance (student_id, attendance_date, attendance_time_in, attendance_log, coordinator_id, organization_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute([$student_id, $attendance_date, $attendance_time_in, $attendance_log, $coordinator_id, $organization_id]);
        return $result;
    }

    public function AttendanceTimeOut($attendance_id, $attendance_time_out)
    {
        $sql = "UPDATE tbl_attendance SET attendance_time_out = ? WHERE attendance_id = ?";
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute([$attendance_time_out, $attendance_id]);
        return $result;
    }
}
