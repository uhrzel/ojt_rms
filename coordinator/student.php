<?php
require_once('init.php');

if(!isset($_GET['student_id']) || $_GET['student_id'] == false) {
    header('Location: students.php');
}

$student = $get_student->getStudent($_GET['student_id']);
$tasks = $get_task->getAllTasksByStudent($_GET['student_id']);
$attendances = $get_attendance->getStudentAttendance($_GET['student_id']);

$title = $student['first_name'] . ' ' . $student['last_name'];
$curr_page = basename(__FILE__);


?>

<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
            <div class="container-fluid">
                <div class="page-header-content">
                    <h1 class="page-header-title d-inline-block">
                        <div class="page-header-icon"><i data-feather="user"></i></div>
                        <span class="text-uppercase">
                            <?= $student['first_name'] . ' ' . $student['last_name']; ?>
                        </span>
                    </h1>

                    <!-- <div class="float-right">
                        <a class="btn btn-success mr-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#graduateStudentModal">
                            <i class="fas fa-graduation-cap"></i>
                        </a>
                    </div> -->
                </div>
            </div>
        </div>

        <!--Table-->
        <div class="container-fluid mt-n10">
            <?php require_once('components/alert.php'); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="information-tab" data-toggle="tab" href="#information"
                                role="tab" aria-controls="information" aria-selected="true">Information</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="tasks-tab" data-toggle="tab" href="#tasks" role="tab"
                                aria-controls="tasks" aria-selected="false">Tasks</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="attendances-tab" data-toggle="tab" href="#attendances" role="tab"
                                aria-controls="attendances" aria-selected="false">Attendances</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">

                        <!--students information-->
                        <div class="tab-pane fade show active" id="information" role="tabpanel"
                            aria-labelledby="information-tab">
                            <div class="card-title text-uppercase" title="Student Name">
                                <i class="fas fa-user-graduate mr-2"></i>
                                <?= $student['first_name'] . ' ' . $student['last_name']; ?>
                            </div>
                            
                            <div class="card-title" title="Student ID Number">
                                <i class="fas fa-id-card mr-2"></i>
                                <?= $student['student_id_number']; ?>
                            </div>

                            <div class="card-title" title="Student Email">
                                <i class="fas fa-envelope mr-2"></i>
                                <?= $student['user_email']; ?>
                                <?php if($student['user_status'] == 'Verified'): ?>
                                <span class="badge badge-success">
                                    <?= $student['user_status']; ?>
                                </span>
                                <?php else: ?>
                                <span class="badge badge-danger">
                                    <?= $student['user_status']; ?>
                                </span>
                                <?php endif; ?>
                            </div>

                            <div class="card-title" title="Student Course">
                                <i class="fas fa-book mr-2"></i>
                                <?= $student['course_name']; ?>
                            </div>

                            <div class="card-title" title="Student Contact Number">
                                <i class="fa fa-address-book mr-2"></i>
                                <?= $student['contact_number']; ?>
                            </div>

                            <div class="card-title text-uppercase" title="Student Address">
                                <i class="fas fa-map mr-2"></i>
                                <?= $student['address']; ?>
                            </div>
                        </div>

                        <!--students tasks-->
                        <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Task Name</th>
                                            <th>Task Description</th>
                                            <th>Task Status</th>
                                            <th>Task Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($tasks as $task): ?>
                                        <tr>
                                            <td><?= $task['task_name']; ?></td>
                                            <td><?= $task['task_description']; ?></td>
                                            <td>
                                                <?php 
                                                    $task_status = $task['task_status'];
                                                    if($task_status == 'Approved') {
                                                        echo '<span class="badge badge-success">Approved</span>';
                                                    } else if($task_status == 'Pending') {
                                                        echo '<span class="badge badge-warning">Pending</span>';
                                                    } else {
                                                        echo '<span class="badge badge-danger">Rejected</span>';
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="task_student.php?task_id=<?= $task['task_id']; ?>">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!--students attendances-->
                        <div class="tab-pane fade" id="attendances" role="tabpanel" aria-labelledby="attendances-tab">
                            <div class="card-title text-uppercase">
                                <?php 
                                    $total_training_hours = $get_attendance->getTotalTrainingHours($student['student_id']);
                                ?>
                                <i class="fas fa-clock mr-2"></i>
                                Working Hours: 
                                <span class="badge badge-success">
                                <?= $total_training_hours; ?>
                                </span>
                                Remaining Hours:
                                <span class="badge badge-warning">
                                <?= $student['required_hours'] - $total_training_hours; ?>
                                </span> - (<?= $student['required_hours']; ?> hours required)
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable_Attendance" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Log</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($attendances as $attendance): ?>
                                        <tr>
                                            <td><?= $attendance['attendance_date']; ?></td>
                                            <td><?= $attendance['attendance_time_in']; ?></td>
                                            <td><?= $attendance['attendance_time_out']; ?></td>
                                            <td>
                                                <?php 
                                                    $attendance_log = $attendance['attendance_log'];
                                                    if($attendance_log == 'Morning') {
                                                        echo '<span class="badge badge-success">Morning</span>';
                                                    } else if($attendance_log == 'Afternoon') {
                                                        echo '<span class="badge badge-success">Afternoon</span>';
                                                    } else {
                                                        echo '<span class="badge badge-danger">Absent</span>';
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--End Table-->

        <!-- create graduate student modal -->
        <div class="modal fade" id="graduateStudentModal" tabindex="-1" role="dialog" aria-labelledby="graduateStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="graduateStudentModalLabel">Graduate Student</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="student.php" method="POST">
                            <div class="form-group">
                                <label for="graduate_student_id">Student ID</label>
                                <input type="text" class="form-control" id="graduate_student_id" name="graduate_student_id" value="<?= $student['student_id']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="graduate_student_name">Student Name</label>
                                <input type="text" class="form-control" id="graduate_student_name" name="graduate_student_name" value="<?= $student['first_name'] . ' ' . $student['last_name']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="total_tasks">Total Tasks</label>
                                <input type="text" class="form-control" id="total_tasks" name="total_tasks" value="<?= count($tasks); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="total_training_hours">Total Training Hours</label>
                                <input type="text" class="form-control" id="total_training_hours" name="total_training_hours" value="<?= $total_training_hours; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="complete_student">Complete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once('components/footer.php'); ?>