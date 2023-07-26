<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $course_id = $_POST['course_id'];

    $create_course = new Course();
    $create_course->deleteCourse($course_id);
}