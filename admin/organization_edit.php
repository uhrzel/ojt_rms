<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $organization_id = $_POST['organization_id'];
    $organization_name = $_POST['organization_name'];
    $organization_description = $_POST['organization_description'];
    $organization_contact_number = $_POST['organization_contact_number'];
    $organization_address = $_POST['organization_address'];
    $organization_email = $_POST['organization_email'];

    $create_organization = new Organization();
    $create_organization->updateOrganization($organization_name, $organization_description, $organization_contact_number, $organization_address, $organization_email, $organization_id);
}