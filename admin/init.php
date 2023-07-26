<?php
session_start();

if(!isset($_SESSION['admin_id']) || $_SESSION['admin_id'] == false) {
    header('Location: auth/signin.php');
}

$user_id = $_SESSION['admin_id'];

require_once('../classes/AutoLoader.php');

$get_admin = new User();
$admin = $get_admin->getAdminUser($user_id);

$get_organization = new Organization();
$organizations = $get_organization->getAllOrganizations();

$get_coordinator = new Coordinator();
$coordinators = $get_coordinator->getAllCoordinators();

$get_student = new Student();
$students = $get_student->getAllStudents();

$get_course = new Course();
$courses = $get_course->getAllCourses();

$get_attendance = new Attendance();

$get_task = new Task();
