<?php
session_start();

if(!isset($_SESSION['coordinator_id']) || $_SESSION['coordinator_id'] == false) {
    header('Location: auth/signin.php');
}

$coordinator_id = $_SESSION['coordinator_id'];

require_once('../classes/AutoLoader.php');

$get_coordinator = new Coordinator();
$coordinator = $get_coordinator->getCoordinator($coordinator_id);
$coordinators = $get_coordinator->getAllCoordinatorsByOrganization($coordinator['organization_id']);

$get_student = new Student();
$students = $get_student->getStudentsByOrganization($coordinator['organization_id']);

$get_task = new Task();
$coordinator_tasks = $get_task->getAllTasksByCoordinator($coordinator_id);
$student_tasks = $get_task->getStudentTaskByOrganization($coordinator['organization_id']);

$get_attendance = new Attendance();
$attendances = $get_attendance->getAttendanceByOrganization($coordinator['organization_id']);