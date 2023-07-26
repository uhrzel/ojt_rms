<?php

session_start();

require_once('../classes/AutoLoader.php');

$task_id = $_GET['task_id'];
$task_status = $_GET['task_status'];

$get_task = new Task();
$get_task->updateStudentTaskStatus($task_id, $task_status);