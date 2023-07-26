<?php
require_once('init.php');

if(!isset($_GET['student_id']) || empty($_GET['student_id']) || !is_numeric($_GET['student_id'])){
    header('Location: index.php');
}

$student_id = $_GET['student_id'];
$student = $get_student->getStudent($student_id);
$tasks = $get_task->getAllTasksByStudent($student_id);
$attendances = $get_attendance->getStudentAttendance($student_id);

$title = 'Student Details';
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
                        <span>
                            <?= $student['first_name'] . ' ' . $student['last_name']; ?>
                        </span>
                    </h1>

                    <div class="float-right">
                        <a class="btn btn-dark btn-icon-split ml-2" href="students.php">
                            <span class="icon text-white-600">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                        </a>

                        <a class="btn btn-danger btn-icon-split ml-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#deletestudentModal">
                            <span class="icon text-white-600">
                                <i class="fas fa-trash"></i>
                            </span>
                        </a>

                        <a class="btn btn-white btn-icon-split ml-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#editstudentModal">
                            <span class="icon text-gray-600">
                                <i class="fas fa-edit"></i>
                            </span>
                        </a>
                    </div>
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
                            <a class="nav-link active" id="students-tab" data-toggle="tab" data-target="#students"
                                href="#students" role="tab" aria-controls="students" aria-selected="false">
                                Details</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="tasks-tab" data-toggle="tab" data-target="#tasks" href="#tasks"
                                role="tab" aria-controls="tasks" aria-selected="false">
                                Tasks</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="attendance-tab" data-toggle="tab" data-target="#attendance"
                                href="#attendance" role="tab" aria-controls="attendance" aria-selected="false">
                                Attendance</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="students" role="tabpanel"
                            aria-labelledby="students-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="student_id_number">ID Number</label>
                                        <input type="text" class="form-control" id="student_id_number"
                                            name="student_id_number" value="<?= $student['student_id_number']; ?>"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="course_id">Course</label>
                                        <input type="text" class="form-control" id="course_id" name="course_id"
                                            value="<?= $student['course_name']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="<?= $student['user_email']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="text" class="form-control" id="status" name="status"
                                            value="<?= $student['user_status']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            value="<?= $student['first_name']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            value="<?= $student['last_name']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_number">Contact Number</label>
                                        <input type="text" class="form-control" id="contact_number"
                                            name="contact_number" value="<?= $student['contact_number']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="<?= $student['address']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="school_year">School Year</label>
                                        <input type="text" class="form-control" id="school_year" name="school_year"
                                            value="<?= $student['school_year']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organization">Organization</label>
                                        <input type="text" class="form-control" id="organization" name="organization"
                                            value="<?= $get_organization->getOrganization($student['organization_id'])['organization_name']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="text" class="form-control" id="start_date" name="start_date"
                                            value="<?= $student['start_date']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="required_hours">Required Hours</label>
                                        <input type="text" class="form-control" id="required_hours"
                                            name="required_hours" value="<?= $student['required_hours']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Task Name</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($tasks as $task): ?>
                                        <tr>
                                            <td><?= $task['task_name']; ?></td>
                                            <td><?= $task['task_description']; ?></td>
                                            <td>
                                                <?php if($task['task_status'] == 'Approved'): ?>
                                                <span class="badge badge-success"><?= $task['task_status']; ?></span>
                                                <?php elseif($task['task_status'] == 'Rejected'): ?>
                                                <span class="badge badge-danger"><?= $task['task_status']; ?></span>
                                                <?php else: ?>
                                                <span class="badge badge-warning"><?= $task['task_status']; ?></span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
                            <div class="card-title text-uppercase">
                                <?php 
                                    $total_training_hours = $get_attendance->getTotalTrainingHours($student['student_id']);
                                ?>
                                <i class="fas fa-clock mr-2"></i>
                                Working Hours:
                                <span class="badge badge-success">
                                    <?= $total_training_hours; ?>
                                </span>
                                (<?= $student['required_hours']; ?> hours required)
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable_Attendance" width="100%"
                                    cellspacing="0">
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
                                                <span class="badge badge-success">
                                                    <?= $attendance['attendance_log']; ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- edit student modal -->
                <div class="modal fade" id="editstudentModal" data-backdrop="static" tabindex="-1" role="dialog"
                    aria-labelledby="editstudentModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <form method="POST" action="student_edit.php">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editstudentModalLabel">Update student</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <input type="hidden" name="student_id" value="<?= $student['student_id']; ?>">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="student_id_number">Student ID Number</label>
                                                <input type="text" class="form-control" id="student_id_number"
                                                    name="student_id_number" placeholder="Enter student id number"
                                                    value="<?= $student['student_id_number']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="course_id">Course</label>
                                                <select class="form-control" id="course_id" name="course_id" required>
                                                    <?php foreach($courses as $course): ?>
                                                    <option value="<?= $course['course_id']; ?>"
                                                        <?php if($course['course_id'] == $student['course_id']): ?>
                                                        selected
                                                        <?php endif; ?>>
                                                        <?= $course['course_name']; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input type="text" class="form-control" id="first_name"
                                                    name="first_name" placeholder="Enter first name"
                                                    value="<?= $student['first_name']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name"
                                                    placeholder="Enter last name" value="<?= $student['last_name']; ?>"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="student_contact_number">Contact Number</label>
                                                <input type="text" class="form-control" id="student_contact_number"
                                                    name="student_contact_number"
                                                    placeholder="Enter student Contact Number"
                                                    value="<?= $student['contact_number']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    placeholder="Enter address" value="<?= $student['address']; ?>"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="school_year">School Year</label>
                                                <select class="form-control" id="school_year" name="school_year" required>
                                                    <?php for($i = 2019; $i <= 2030; $i++): ?>
                                                    <option value="<?= $i; ?>"
                                                        <?php if($i == $student['school_year']): ?>
                                                        selected
                                                        <?php endif; ?>>
                                                        <?= $i; ?>
                                                    </option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="organization_id">Organization</label>
                                                <select class="form-control" id="organization_id" name="organization_id"
                                                    required>
                                                    <?php foreach($organizations as $organization): ?>
                                                    <option value="<?= $organization['organization_id']; ?>"
                                                        <?php if($organization['organization_id'] == $student['organization_id']): ?>
                                                        selected
                                                        <?php endif; ?>>
                                                        <?= $organization['organization_name']; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="start_date">Start Date (<?= $student['start_date']; ?>)</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="required_hours">Required Hours</label>
                                                <input type="number" class="form-control" id="required_hours"
                                                    name="required_hours" placeholder="Enter required hours"
                                                    value="<?= $student['required_hours']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="student_email">Email</label>
                                                <input type="email" class="form-control" id="student_email"
                                                    name="student_email" placeholder="Enter student Email"
                                                    value="<?= $student['user_email']; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" name="edit_student" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end edit student modal -->

                <!-- delete student modal -->
                <div class="modal fade" id="deletestudentModal" data-backdrop="static" tabindex="-1" role="dialog"
                    aria-labelledby="deletestudentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form method="POST" action="student_delete.php">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deletestudentModalLabel">
                                        <?= $student['first_name'] . ' ' . $student['last_name']; ?>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this student?
                                    <input type="hidden" name="student_id" value="<?= $student['student_id']; ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger" name="student_delete">Delete</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end delete student modal -->

    </main>

    <?php require_once('components/footer.php'); ?>