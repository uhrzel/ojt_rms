<?php

require_once('classes/API_AutoLoader.php');

date_default_timezone_set('Asia/Manila');

$get_attendance = new Attendance();
$student_id = $_GET['student_id'];
$organization_id = $_GET['organization_id'];

//dummy data
// $student_id = 422;
// $organization_id = 24;

$attendance = $get_attendance->getTotalTrainingHours($student_id, $organization_id);
echo $attendance;