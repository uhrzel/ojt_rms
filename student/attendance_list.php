<?php

require_once('classes/API_AutoLoader.php');

$student_id = $_GET['student_id'];
$organization_id = $_GET['organization_id'];

$get_attendance = new Attendance();
$attendance = $get_attendance->getAttendance($student_id, $organization_id);

echo json_encode($attendance);
