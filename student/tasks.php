<?php

require_once('classes/API_AutoLoader.php');

$student_id = $_GET['student_id'];
$organization_id = $_GET['organization_id'];

$get_task = new Task();
$tasks = $get_task->getStudentTask($student_id, $organization_id);
/* $tasks = $get_task->getTasks($student_id, $organization_id); */

echo json_encode($tasks);
