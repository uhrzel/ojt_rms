<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $student_id = $_POST['student_id'];
    $organization_id = $_POST['organization_id'];
    $school_year = $_POST['school_year'];
    $start_date = $_POST['start_date'];
    $total_training_hours = $_POST['total_training_hours'];

    $create_enrollment = new Enrollment();
    $create_enrollment->createEnrollment($student_id, $organization_id, $school_year, $start_date, $total_training_hours);
}