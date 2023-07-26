<?php

require_once('classes/API_AutoLoader.php');

$organization_id = $_GET['organization_id'];

$get_coordinator = new Coordinator();
$coordinator = $get_coordinator->getCoordinators($organization_id);

echo json_encode($coordinator);