<?php

require_once('classes/API_AutoLoader.php');

$attendance = new Attendance();

$attendance_log = $_GET['attendance_log'];
$student_id = $_GET['student_id'];
$attendance_date = $_GET['attendance_date'];
$attendance_time = $_GET['attendance_time'];
$coordinator_id = $_GET['coordinator_id'];
$organization_id = $_GET['organization_id'];

//dummy data
// $attendance_log = 'Afternoon';
// $student_id = 1;
// $attendance_date = '2020-10-10';
// $attendance_time = '10:00:00';
// $coordinator_id = 1;
// $organization_id = 1;


//UNFIX 
/* $check_attendance = $attendance->getAttendanceAfternoon($student_id, $attendance_date, $organization_id);

if ($attendance_log == 'Afternoon') {
    if ($check_attendance) {
        $result = $attendance->AttendanceTimeOut($check_attendance['attendance_id'], $attendance_time);
        if ($result) {
            echo 'Attendance Time Out Success';
        } else {
            echo 'Attendance Time Out Failed';
        }
    } else if (!$check_attendance) {
        $result = $attendance->AttendanceTimeIn($student_id, $attendance_date, $attendance_time, $attendance_log, $coordinator_id, $organization_id);
        if ($result) {
            echo 'Attendance Time In Success';
        } else {
            echo 'Attendance Time In Failed';
        }
    } else {
        echo 'Attendance Already Checked';
    }
}
 */

$check_attendance = $attendance->getAttendanceAfternoon($student_id, $attendance_date, $organization_id);

if ($attendance_log == 'Afternoon') {
    if ($check_attendance) {
        if ($check_attendance['attendance_time_out']) {
            echo 'Attendance Already Checked Out';
        } else {
            $result = $attendance->AttendanceTimeOut($check_attendance['attendance_id'], $attendance_time);
            if ($result) {
                echo 'Attendance Time Out Success';
            } else {
                echo 'Attendance Time Out Failed';
            }
        }
    } else {
        $result = $attendance->AttendanceTimeIn($student_id, $attendance_date, $attendance_time, $attendance_log, $coordinator_id, $organization_id);
        if ($result) {
            echo 'Attendance Time In Success';
        } else {
            echo 'Attendance Time In Failed';
        }
    }
} else {
    echo 'Invalid Attendance Log';
}
