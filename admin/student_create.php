<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['student_email'];
    $student_id_number = $_POST['student_id_number'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_number = $_POST['student_contact_number'];
    $course_id = $_POST['course_id'];
    $address = $_POST['address'];

    $student = new Student();
    $student->createStudent($email, $student_id_number, $first_name, $last_name, $contact_number, $course_id, $address);
}

