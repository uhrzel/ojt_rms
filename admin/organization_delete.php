<?php

session_start();

require_once('../classes/AutoLoader.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $organization_id = $_POST['organization_id'];

    $create_organization = new Organization();
    $create_organization->deleteOrganization($organization_id);
}