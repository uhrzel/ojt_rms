<?php

session_start();

require_once('../classes/AutoLoader.php');

$attendance_id = $_GET['attendance_id'];

$delete_attendance = new Attendance();
$delete_attendance->deleteAttendance($attendance_id);
