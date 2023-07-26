<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $coordinator_id = $_POST['coordinator_id'];
    $email = $_POST['coordinator_email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_number = $_POST['coordinator_contact_number'];
    $organization_id = $_POST['organization_id'];
    
    $update_coordinator = new Coordinator();
    $update_coordinator->updateCoordinator($coordinator_id, $email, $first_name, $last_name, $contact_number, $organization_id);
}