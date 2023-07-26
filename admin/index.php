<?php
require_once('init.php');

$title = 'Dashboard';
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
                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                        <span>
                            <?= $title; ?>
                        </span>
                    </h1>

                    <a class="btn btn-white float-right" id="create_new" href="javascript:void(0);" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon text-white-600 mr-2">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">
                            Create New
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                        aria-labelledby="create_new">
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                data-target="#createOrganizationModal">
                                Organization
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                data-target="#createcoordinatorModal">
                                Coordinator
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                data-target="#createcourseModal">
                                Course
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!--Table-->
        <div class="container-fluid mt-n10">
            <?php require_once('components/alert.php'); ?>

            <!--Card Primary-->
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <p>
                                Coordinator
                            </p>
                            <p>
                                <?=count($coordinators); ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="coordinators.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <p>
                                OJT Students
                            </p>
                            <p>
                                <?=count($students); ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="students.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <p>
                                Course
                            </p>
                            <p>
                                <?=count($courses); ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="courses.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Card Primary-->

            <div class="card mb-4">
                <div class="card-header">
                    Organization/s <span class="badge badge-primary mx-2"><?=count($organizations); ?></span>
                </div>
                <div class="card-body">
                    <?php if(count($organizations) > 0): ?>
                    <div class="datatable table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Organization Name</th>
                                    <th>Organization Address</th>
                                    <th>Organization Email</th>
                                    <th>OJT Students</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($organizations as $organization): ?>
                                <tr>
                                    <td>
                                        <?=$organization['organization_name']; ?>
                                    </td>
                                    <td>
                                        <?=$organization['organization_address']; ?>
                                    </td>
                                    <td>
                                        <?=$organization['organization_email']; ?>
                                    </td>
                                    <td>
                                        <?php $ojt_students = $get_student->getStudentsByOrganization($organization['organization_id']); ?>
                                        <?php if(count($ojt_students) > 0): ?>
                                            <span class="badge badge-success badge-md">
                                                <?=count($ojt_students); ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="badge badge-danger badge-sm">
                                                N/A
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="organization.php?organization_id=<?=$organization['organization_id']; ?>"
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
                        No organization found.
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