<?php

require_once('classes/API_AutoLoader.php');

$get_course = new Course();
$courses = $get_course->getCourses();

$get_organization = new Organization();
$organizations = $get_organization->getOrganizations();

$result['courses'] = $courses;
$result['organizations'] = $organizations;
echo json_encode($result);