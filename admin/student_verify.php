<?php

require_once('init.php');

if(isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    $student = new Student();
    $student->verifyStudent($student_id);
}else{
    $_SESSION['error'] = 'Student not found.';
    header('Location: students.php');
}