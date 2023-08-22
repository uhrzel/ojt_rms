<?php


require_once('classes/API_AutoLoader.php');

$user_id = $_GET['user_id'];

$get_student = new Student();
$get_course = new Course();
$get_organization = new Organization();
$get_attendance = new Attendance();
$get_task = new Task();
$get_coordinator = new Coordinator();

$student = $get_student->getStudent($user_id);
$course = $get_course->getCourse($student['course_id']);
$organization = $get_organization->getOrganization($student['organization_id']);
$attendance = $get_attendance->getAttendance($user_id);
$task = $get_task->getStudentTask($user_id);
$coordinator = $get_coordinator->getCoordinators($student['organization_id']);
$remaining_hours = $get_attendance->getTotalTrainingHours($user_id);
$tasks = $get_task->getStudentTask($user_id);
$assigned_task = $get_task->getCoordinatorTask($student['organization_id']);

$assigned_task_values = array_column($assigned_task, 'task_name');
$assigned_task_description = array_column($assigned_task, 'task_description');
$assigned_task_created = array_column($assigned_task, 'task_created');

echo json_encode([
    'user' => $student,
    'course' => $course,
    'organization' => $organization,
    'attendance' => $attendance,
    'task' => $task,
    'coordinator' => $coordinator,
    'remaining_hours' => $remaining_hours,
    'tasks' => $tasks,
    'assigned_task_values' => $assigned_task_values,
    'assigned_task_description' => $assigned_task_description,
    'assigned_task_created' => $assigned_task_created,
    'total_tasks' => count($tasks),
    'first_name' => $student['first_name'],
    'last_name' => $student['last_name'],
    'email' => $student['user_email']
]);
