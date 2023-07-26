<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $course_id = $_POST['course_id'];
    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];

    $create_course = new Course();
    $create_course->updateCourse($course_id, $course_code, $course_name);
}