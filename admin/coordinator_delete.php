<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $coordinator_id = $_POST['coordinator_id'];

    $delete_coordinator = new Coordinator();
    $delete_coordinator->deleteCoordinator($coordinator_id);
}