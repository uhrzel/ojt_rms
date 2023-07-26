<?php
require_once('init.php');

if(!isset($_GET['organization_id']) || empty($_GET['organization_id']) || !is_numeric($_GET['organization_id'])){
    header('Location: index.php');
}

$organization_id = $_GET['organization_id'];
$organization = $get_organization->getOrganization($organization_id);
$coordinators = $get_coordinator->getAllCoordinatorsByOrganization($organization_id);
$students = $get_student->getStudentsByOrganization($organization_id);

$title = 'Organization Details';
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
                            <?= $organization['organization_name']; ?>
                        </span>
                    </h1>

                    <div class="float-right">
                        <a class="btn btn-dark btn-icon-split ml-2" href="index.php">
                            <span class="icon text-white-600">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                        </a>

                        <a class="btn btn-danger btn-icon-split ml-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#deleteOrganizationModal">
                            <span class="icon text-white-600">
                                <i class="fas fa-trash"></i>
                            </span>
                        </a>

                        <a class="btn btn-white btn-icon-split ml-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#editOrganizationModal">
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
                                href="#students" role="tab" aria-controls="students" aria-selected="false">OJT
                                Students</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="coordinators-tab" data-toggle="tab" data-target="#coordinators"
                                href="#coordinators" role="tab" aria-controls="coordinators"
                                aria-selected="false">Coordinators</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="organization-tab" data-toggle="tab" data-target="#organization"
                                href="#organization" role="tab" aria-controls="organization" aria-selected="true">
                                Details
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">

                        <!-- Organization Details -->
                        <div class="tab-pane fade" id="organization" role="tabpanel" aria-labelledby="organization-tab">
                            <div class="card border-0 bg-transparent shadow-none">
                                <div class="card-header">
                                    <span class="d-inline-block">
                                        Organization Details
                                    </span>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="organization_name">Name</label>
                                                <input type="text" class="form-control" id="organization_name"
                                                    name="organization_name"
                                                    value="<?= $organization['organization_name']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="organization_email">Email</label>
                                                <input type="text" class="form-control" id="organization_email"
                                                    name="organization_email"
                                                    value="<?= $organization['organization_email']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="organization_contact_number">Contact Number</label>
                                                <input type="text" class="form-control" id="organization_contact_number"
                                                    name="organization_contact_number"
                                                    value="<?= $organization['organization_contact_number']; ?>"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="organization_address">Address</label>
                                                <input type="text" class="form-control" id="organization_address"
                                                    name="organization_address"
                                                    value="<?= $organization['organization_address']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="organization_description">Description</label>
                                                <textarea class="form-control" id="organization_description"
                                                    name="organization_description" rows="3"
                                                    disabled><?= $organization['organization_description']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--coordinators-->
                        <div class="tab-pane fade" id="coordinators" role="tabpanel" aria-labelledby="coordinators-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact Number</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($coordinators as $coordinator) : ?>
                                        <tr>
                                            <td><?= $coordinator['first_name'] . ' ' . $coordinator['last_name']; ?>
                                            </td>
                                            <td><?= $coordinator['user_email']; ?>
                                            </td>
                                            <td><?= $coordinator['contact_number']; ?></td>
                                            <td>
                                                <a href="coordinator.php?coordinator_id=<?= $coordinator['coordinator_id']; ?>"
                                                    class="btn btn-primary btn-sm" target="_blank">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!--students-->
                        <div class="tab-pane fade show active" id="students" role="tabpanel"
                            aria-labelledby="students-tab">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable_1" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Start Date</th>
                                            <th>Total Training Hours</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($students as $student) : ?>
                                        <tr>
                                            <td><?= $student['first_name'] . ' ' . $student['last_name']; ?>
                                            </td>
                                            <!-- format date -->
                                            <td><?= date('F d, Y', strtotime($student['start_date'])); ?></td>
                                            <td><?= $student['required_hours']; ?></td>
                                            <td>
                                                <a href="student.php?student_id=<?= $student['student_id']; ?>"
                                                    class="btn btn-primary btn-sm" target="_blank">
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
            </div>
        </div>
        <!--End Table-->

        <!-- edit organization modal -->
        <div class="modal fade" id="editOrganizationModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="editOrganizationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" action="organization_edit.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editOrganizationModalLabel">Update Organization</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <input type="hidden" name="organization_id"
                                    value="<?= $organization['organization_id']; ?>">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organization_name">Name</label>
                                        <input type="text" class="form-control" id="organization_name"
                                            name="organization_name" placeholder="Enter Organization Name"
                                            value="<?= $organization['organization_name']; ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organization_address">Address</label>
                                        <input type="text" class="form-control" id="organization_address"
                                            name="organization_address" placeholder="Enter Organization Address"
                                            value="<?= $organization['organization_address']; ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organization_email">Email</label>
                                        <input type="email" class="form-control" id="organization_email"
                                            name="organization_email" placeholder="Enter Organization Email"
                                            value="<?= $organization['organization_email']; ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organization_contact_number">Contact Number</label>
                                        <input type="text" class="form-control" id="organization_contact_number"
                                            name="organization_contact_number"
                                            placeholder="Enter Organization Contact Number"
                                            value="<?= $organization['organization_contact_number']; ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="organization_description">Description</label>
                                        <textarea class="form-control" id="organization_description" rows="3"
                                            name="organization_description" placeholder="Enter Organization Description"
                                            required><?= $organization['organization_description']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" name="edit_organization" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end edit organization modal -->

        <!-- delete organization modal -->
        <div class="modal fade" id="deleteOrganizationModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="deleteOrganizationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="organization_delete.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteOrganizationModalLabel">
                                <?= $organization['organization_name']; ?>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this organization?
                            <input type="hidden" name="organization_id"
                                value="<?= $organization['organization_id']; ?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" name="organization_delete">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end delete organization modal -->

    </main>

    <?php require_once('components/footer.php'); ?>