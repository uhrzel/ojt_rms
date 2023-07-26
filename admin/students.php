<?php
require_once('init.php');

$title = 'Students';
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
                        <div class="page-header-icon"><i data-feather="users"></i></div>
                        <span>
                            <?= $title; ?> <span class="badge badge-white ml-2"><?=count($students); ?></span>
                        </span>
                    </h1>

                    <div class="float-right">
                        <a class="btn btn-dark btn-icon-split ml-2" href="index.php">
                            <span class="icon text-white-600">
                                <i class="fas fa-arrow-left"></i>
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
                    <i class="fas fa-table mr-1"></i>
                    Student List
                </div>
                <div class="card-body">
                    <?php if(count($students) > 0): ?>
                    <div class="datatable table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>ID Number</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($students as $student): ?>
                                <tr>
                                    <td>
                                        <?=$student['first_name'] . ' ' . $student['last_name']; ?>
                                    </td>
                                    <td>
                                        <?=$student['user_email']; ?>
                                    </td>
                                    <td>
                                        <?=$student['student_id_number']; ?>
                                    </td>
                                    <td>
                                        <?=$student['course_name']; ?>
                                    </td>
                                    <td>
                                    <?php if($student['isVerified'] == 1): ?>
                                        <span class="badge badge-success">
                                            Verified
                                        </span>
                                        <?php else: ?>
                                        <span class="badge badge-danger">
                                            Not Verified    
                                        </span>
                                        <?php endif; ?>

                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle text-white"
                                            id="student_verify_option" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                                            aria-labelledby="student_verify_option">

                                            <?php if($student['isVerified'] == 1): ?>

                                            <li>

                                                <a href="student_unverify.php?student_id=<?=$student['student_id']; ?>"
                                                    class="btn btn-sm" title="Unverify">
                                                    <i class="fas fa-times"></i> Unverify
                                                </a>
                                                
                                            </li>

                                            <?php else: ?>

                                            <li>

                                                <a href="student_verify.php?student_id=<?=$student['student_id']; ?>"
                                                    class="btn btn-sm" title="Verify">
                                                    <i class="fas fa-check"></i> Verify
                                                </a>

                                            </li>

                                            <?php endif; ?>
                                            
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="student.php?student_id=<?=$student['student_id']; ?>"
                                            class="btn btn-primary btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No students found.
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!--End Table-->

        <!-- create student Modal-->
        <div class="modal fade" id="createstudentModal" tabindex="-1" role="dialog"
            aria-labelledby="createstudentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="student_create.php">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createstudentModalLabel">Create Student</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="student_id_number">Student ID Number</label>
                                            <input type="text" class="form-control" id="student_id_number"
                                                name="student_id_number" placeholder="ID Number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="course_id">Course</label>
                                            <select class="form-control" id="course_id" name="course_id" required>
                                                <option hidden disabled selected>Select Course</option>
                                                <?php foreach($courses as $course): ?>
                                                <option value="<?=$course['course_id']; ?>">
                                                    <?=$course['course_name']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name"
                                                placeholder="Enter first name" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name"
                                                placeholder="Enter last name" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="student_contact_number">Contact Number</label>
                                            <input type="text" class="form-control" id="student_contact_number"
                                                name="student_contact_number" placeholder="Enter student Contact Number"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Enter address" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="organization_id">Organization</label>
                                            <select class="form-control" id="organization_id" name="organization_id"
                                                required>
                                                <option hidden disabled selected>Select Organization</option>
                                                <?php foreach($organizations as $organization): ?>
                                                <option value="<?=$organization['organization_id']; ?>">
                                                    <?=$organization['organization_name']; ?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date"
                                                placeholder="Enter start date" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="school_year">School Year</label>
                                            <select class="form-control" name="school_year" id="school_year" required>
                                                <option selected hidden disabled>Select School Year</option>
                                                <option value="2022-2023">2022-2023</option>
                                                <option value="2021-2022">2023-2024</option>
                                                <option value="2020-2021">2024-2025</option>
                                                <option value="2019-2020">2025-2026</option>
                                                <option value="2018-2019">2026-2027</option>
                                                <option value="2017-2018">2027-2028</option>
                                                <option value="2016-2017">2028-2029</option>
                                                <option value="2015-2016">2029-2030</option>
                                                <option value="2014-2015">2030-2031</option>
                                                <option value="2013-2014">2031-2032</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_training_hours">Total Training Hours</label>
                                            <input type="number" class="form-control" id="total_training_hours"
                                                name="total_training_hours" placeholder="Enter total training hours"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="student_email">Email</label>
                                            <input type="email" class="form-control" id="student_email"
                                                name="student_email" placeholder="Enter student Email" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Enter password" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirm_password"
                                                name="confirm_password" placeholder="Enter confirm password" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" name="create_student" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End create student Modal-->

    </main>

    <?php require_once('components/footer.php'); ?>