<?php

require_once('classes/API_AutoLoader.php');

$register = new Register();
$get_course = new Course();
$get_organization = new Organization();

$email = $_POST['user_email'];
$student_id_number = $_POST['student_id_number'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$contact_number = $_POST['contact_number'];
$course_code = $_POST['course_id'];
$course_id = $get_course->getCourseByCourseCode($course_code)['course_id'];
$address = $_POST['address'];
$password = $_POST['user_password'];
$organization_name = $_POST['organization_id'];
$organization_id = $get_organization->getOrganizationByOrganizationName($organization_name)['organization_id'];
$school_year = $_POST['school_year'];
$start_date = $_POST['start_date'];
$required_hours = $_POST['required_hours'];
$status = 'Pending';
$role = 'Student';

//dummy data
// $email = 'ortegacanillo76@gmail.com';
// $student_id_number = '2018-00001';
// $first_name = 'Canillo';
// $last_name = 'Ortega';
// $contact_number = '09123456789';
// $course_id = '1';


$result = $register->register($email, $password, $status, $role, $student_id_number, $first_name, $last_name, $contact_number, $course_id, $address, $school_year, $organization_id, $start_date, $required_hours);

if ($result == 'Email or Student ID Number already exists') {
    echo $result;
} elseif ($result == 'All fields are required') {
    echo $result;
} elseif ($result == 'Account created successfully. Please check your email for verification.') {
    echo $result;
} else {
    echo 'Something went wrong';
}
