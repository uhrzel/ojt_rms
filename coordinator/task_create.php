<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $coordinator_id = $_POST['coordinator_id'];
    $organization_id = $_POST['organization_id'];
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];

    $create_task = new Task();
    $create_task->createTask($coordinator_id, $organization_id, $task_name, $task_description);
}

