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
                            <?= $title; ?>
                        </span>
                    </h1>
                </div>
            </div>
        </div>

        <!--Table-->
        <div class="container-fluid mt-n10">
            <?php require_once('components/alert.php'); ?>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Students (<?= count($students); ?>)
                </div>
                <div class="card-body">
                    <?php if(count($students) > 0) : ?>
                    <div class="datatable table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($students as $student) : ?>
                                <tr>
                                    <td>
                                        <?= $student['first_name'] . ' ' . $student['last_name']; ?>
                                    </td>
                                    <td>
                                        <?= $student['address']; ?>
                                    </td>
                                    <td>
                                        <?= $student['user_email']; ?>
                                    </td>
                                    <td>
                                        <a href="student.php?student_id=<?= $student['student_id']; ?>"
                                            class="btn btn-primary btn-sm">
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
                        <i class="fas fa-info-circle"></i>
                        No students enrolled yet.
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!--End Table-->

        <!-- create organization modal -->
        <div class="modal fade" id="createOrganizationModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="createOrganizationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" action="organization_create.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createOrganizationModalLabel">Create Organization</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organization_name">Name</label>
                                        <input type="text" class="form-control" id="organization_name"
                                            name="organization_name" placeholder="Enter Organization Name" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organization_address">Address</label>
                                        <input type="text" class="form-control" id="organization_address"
                                            name="organization_address" placeholder="Enter Organization Address"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organization_email">Email</label>
                                        <input type="email" class="form-control" id="organization_email"
                                            name="organization_email" placeholder="Enter Organization Email" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organization_contact_number">Contact Number</label>
                                        <input type="text" class="form-control" id="organization_contact_number"
                                            name="organization_contact_number"
                                            placeholder="Enter Organization Contact Number" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="organization_description">Description</label>
                                        <textarea class="form-control" id="organization_description" rows="3"
                                            name="organization_description" placeholder="Enter Organization Description"
                                            required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" name="create_organization" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end create organization modal -->

        <!-- create student Modal-->
        <div class="modal fade" id="createstudentModal" data-backdrop="static" tabindex="-1" role="dialog"
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
                                                name="student_id_number" placeholder="Enter student id number" required>
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
                                                name="student_contact_number"
                                                placeholder="Enter student Contact Number" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Enter address" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="student_email">Email</label>
                                            <input type="email" class="form-control" id="student_email"
                                                name="student_email" placeholder="Enter student Email" required>
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

        <!-- create coordinator Modal-->
        <div class="modal fade" id="createcoordinatorModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="createcoordinatorModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="coordinator_create.php">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createcoordinatorModalLabel">Create Coordinator</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-row">
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
                                            <label for="coordinator_contact_number">Contact Number</label>
                                            <input type="text" class="form-control" id="coordinator_contact_number"
                                                name="coordinator_contact_number"
                                                placeholder="Enter coordinator Contact Number" required>
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

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="coordinator_email">Email</label>
                                            <input type="email" class="form-control" id="coordinator_email"
                                                name="coordinator_email" placeholder="Enter coordinator Email" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" name="create_coordinator" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End create coordinator Modal-->

        <!-- create course Modal-->
        <div class="modal fade" id="createcourseModal" tabindex="-1" role="dialog"
            aria-labelledby="createcourseModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="course_create.php">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createcourseModalLabel">Create Course</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="course_code">Course Code</label>
                                            <input type="text" class="form-control" id="course_code"
                                                name="course_code" placeholder="Enter course code" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="course_name">Course Name</label>
                                            <input type="text" class="form-control" id="course_name"
                                                name="course_name" placeholder="Enter course name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" name="create_course" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End create course Modal-->

    </main>

    <?php require_once('components/footer.php'); ?>