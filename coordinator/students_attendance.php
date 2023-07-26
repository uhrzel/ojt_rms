<?php
session_start();

require_once('../classes/AutoLoader.php');

$organization_id = $_POST['organization_id'];

$get_attendance = new Attendance();
$attendances = $get_attendance->getAttendanceByOrganization($organization_id);

$get_student = new Student();

$attendance_html = '';

$attendance_html .= '<div class="datatable table-responsive h-100">';
$attendance_html .= '<table class="table table-bordered table-hover">';
$attendance_html .= '<thead>';
$attendance_html .= '<tr>';
$attendance_html .= '<th>Student Name</th>';
$attendance_html .= '<th>Date</th>';
$attendance_html .= '<th>Time In</th>';
$attendance_html .= '<th>Time Out</th>';
$attendance_html .= '<th>Log</th>';
$attendance_html .= '<th></th>';
$attendance_html .= '</tr>';
$attendance_html .= '</thead>';
$attendance_html .= '<tbody>';
foreach($attendances as $attendance){
    $attendance_html .= '<tr>';
    $attendance_html .= '<td>'.$get_student->getStudent($attendance['student_id'])['first_name'].' '.$get_student->getStudent($attendance['student_id'])['last_name'].'</td>';
    $attendance_html .= '<td>'.$attendance['attendance_date'].'</td>';
    $attendance_html .= '<td>'.$attendance['attendance_time_in'].'</td>';
    $attendance_html .= '<td>'.($attendance['attendance_time_out'] == null ? 'N/A' : $attendance['attendance_time_out']).'</td>';
    $attendance_html .= '<td>'.$attendance['attendance_log'].'</td>';
    $attendance_html .= '<td><a href="attendance_delete.php?attendance_id='.$attendance['attendance_id'].'" onclick="return confirm(\'Are you sure you want to delete this attendance?\');" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></td>';
    $attendance_html .= '</tr>';
}
$attendance_html .= '</tbody>';
$attendance_html .= '</table>';
$attendance_html .= '</div>';

if($attendances){
    echo $attendance_html;
} else {
    echo 'error';
}