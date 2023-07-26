<?php
require_once('init.php');

if(!isset($_GET['course_id']) || empty($_GET['course_id']) || !is_numeric($_GET['course_id'])){
    header('Location: index.php');
}

$course_id = $_GET['course_id'];
$course = $get_course->getCourse($course_id);
$students = $get_student->getStudentsByCourse($course_id);

$title = 'Course Details';
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
                            <?= $course['course_code']; ?>
                        </span>
                    </h1>

                    <div class="float-right">
                        <a class="btn btn-dark btn-icon-split ml-2" href="courses.php">
                            <span class="icon text-white-600">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                        </a>

                        <a class="btn btn-danger btn-icon-split ml-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#deletecourseModal">
                            <span class="icon text-white-600">
                                <i class="fas fa-trash"></i>
                            </span>
                        </a>

                        <a class="btn btn-white btn-icon-split ml-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#editcourseModal">
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
                    Course Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="course_name">Name</label>
                                <input type="text" class="form-control" id="course_name" name="course_name"
                                    value="<?= $course['course_name']; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="course_code">Code</label>
                                <input type="text" class="form-control" id="course_code" name="course_code"
                                    value="<?= $course['course_code']; ?>" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    Students (<?= count($students); ?>)
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($students as $student): ?>
                                <tr>
                                    <td><?= $student['student_id_number']; ?></td>
                                    <td><?= $student['first_name'] . ' ' . $student['last_name']; ?></td>
                                    <td><?= $get_student->getStudent($student['student_id'])['user_email']; ?></td>
                                    <td><?= $student['contact_number']; ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" target="_blank"
                                            href="student.php?student_id=<?= $student['student_id']; ?>">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!--End Table-->

        <!-- edit course modal -->
        <div class="modal fade" id="editcourseModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="editcourseModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="course_edit.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editcourseModalLabel">Update course</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <input type="hidden" name="course_id" value="<?= $course['course_id']; ?>">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="course_code">Code</label>
                                        <input type="text" class="form-control" id="course_code" name="course_code"
                                            placeholder="Enter course Code" value="<?= $course['course_code']; ?>"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="course_name">Name</label>
                                        <input type="text" class="form-control" id="course_name" name="course_name"
                                            placeholder="Enter course name" value="<?= $course['course_name']; ?>"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" name="edit_course" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end edit course modal -->

        <!-- delete course modal -->
        <div class="modal fade" id="deletecourseModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="deletecourseModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="course_delete.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deletecourseModalLabel">
                                <?= $course['course_name']; ?>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this course?
                            <input type="hidden" name="course_id" value="<?= $course['course_id']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" name="course_delete">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end delete course modal -->

    </main>

    <?php require_once('components/footer.php'); ?>