<?php

require_once('classes/API_AutoLoader.php');

$student_id = $_GET['student_id'];
$task_name = $_GET['task_name'];
$task_description = $_GET['task_description'];

$create_task = new Task();
$result = $create_task->createStudentTask($student_id, $task_name, $task_description);

if($result == 'Cannot be empty'){
    echo $result;
}else{
    echo $result;
}