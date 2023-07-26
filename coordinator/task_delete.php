<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $task_id = $_POST['task_id'];

    $delete_task = new Task();
    $result = $delete_task->deleteCoordinatorTask($task_id);
}

