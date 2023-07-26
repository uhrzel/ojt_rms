<?php

require_once('classes/API_AutoLoader.php');

$task_id = $_GET['task_id'];

$delete_task = new Task();
$result = $delete_task->deleteStudentTask($task_id);

echo $result;