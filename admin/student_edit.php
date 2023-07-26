<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $student_id = $_POST['student_id'];
    $email = $_POST['student_email'];
    $student_id_number = $_POST['student_id_number'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_number = $_POST['student_contact_number'];
    $course_id = $_POST['course_id'];
    $address = $_POST['address'];
    $school_year = $_POST['school_year'];
    $organization_id = $_POST['organization_id'];
    $start_date = $_POST['start_date'];
    $required_hours = $_POST['required_hours'];

    $update_student = new Student();
    $update_student->updateStudent($student_id, $email, $student_id_number, $first_name, $last_name, $course_id, $contact_number, $address, $school_year, $organization_id, $start_date, $required_hours);
}else{
    header('Location: students.php');
}