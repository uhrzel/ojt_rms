<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $student_id = $_POST['student_id'];

    $delete_student = new Student();
    $delete_student->deleteStudent($student_id);
}