<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $task_id = $_POST['task_id'];
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];

    $update_task = new Task();
    $update_task->updateCoordinatorTask($task_id, $task_name, $task_description);
}

