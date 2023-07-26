<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['coordinator_email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_number = $_POST['coordinator_contact_number'];
    $organization_id = $_POST['organization_id'];

    $create_coordinator = new Coordinator();
    $create_coordinator->createCoordinator($email, $first_name, $last_name, $contact_number, $organization_id);
}