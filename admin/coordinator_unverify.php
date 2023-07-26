<?php

require_once('init.php');

if(isset($_GET['coordinator_id'])) {
    $coordinator_id = $_GET['coordinator_id'];

    $coordinator = new Coordinator();
    $coordinator->unverifyCoordinator($coordinator_id);
}else{
    $_SESSION['error'] = 'Coordinator not found.';
    header('Location: coordinators.php');
}