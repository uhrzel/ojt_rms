<?php
require_once('../config/Database.class.php'); // Include your Database class or connection code

$db = new Database();

$courseCodes = $db->getOrganizationName();

echo json_encode($courseCodes);
