<?php
require_once('init.php');

if(!isset($_GET['coordinator_id']) || empty($_GET['coordinator_id']) || !is_numeric($_GET['coordinator_id'])){
    header('Location: index.php');
}

$coordinator_id = $_GET['coordinator_id'];
$coordinator = $get_coordinator->getCoordinator($coordinator_id);
$tasks = $get_task->getAllTasksByCoordinator($coordinator_id);

$title = 'Coordinator Details';
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
                            <?= $coordinator['first_name'] . ' ' . $coordinator['last_name']; ?>
                        </span>
                    </h1>

                    <div class="float-right">
                        <a class="btn btn-dark btn-icon-split ml-2" href="coordinators.php">
                            <span class="icon text-white-600">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                        </a>

                        <a class="btn btn-danger btn-icon-split ml-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#deletecoordinatorModal">
                            <span class="icon text-white-600">
                                <i class="fas fa-trash"></i>
                            </span>
                        </a>

                        <a class="btn btn-white btn-icon-split ml-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#editcoordinatorModal">
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
                            <a class="nav-link active" id="details-tab" data-toggle="tab" data-target="#details"
                                href="#details" role="tab" aria-controls="details" aria-selected="true">
                                Details</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="tasks-tab" data-toggle="tab" data-target="#tasks" href="#tasks"
                                role="tab" aria-controls="tasks" aria-selected="false">
                                Tasks</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="details" role="tabpanel"
                            aria-labelledby="details-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            value="<?= $coordinator['first_name']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            value="<?= $coordinator['last_name']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_number">Contact Number</label>
                                        <input type="text" class="form-control" id="contact_number"
                                            name="contact_number" value="<?= $coordinator['contact_number']; ?>"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="organization">Organization</label>
                                        <input type="text" class="form-control" id="organization" name="organization"
                                            value="<?= $coordinator['organization_name']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="<?= $coordinator['user_email']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_status">Status</label>
                                        <input type="text" class="form-control" id="user_status" name="user_status"
                                            value="<?= $coordinator['user_status']; ?>" disabled>
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
                                                <span class="badge badge-success"><?= $task['task_status']; ?></span>
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

                <!-- edit coordinator modal -->
                <div class="modal fade" id="editcoordinatorModal" data-backdrop="static" tabindex="-1" role="dialog"
                    aria-labelledby="editcoordinatorModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <form method="POST" action="coordinator_edit.php">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editcoordinatorModalLabel">Update coordinator</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <input type="hidden" name="coordinator_id"
                                            value="<?= $coordinator['coordinator_id']; ?>">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input type="text" class="form-control" id="first_name"
                                                    name="first_name" placeholder="Enter first name"
                                                    value="<?= $coordinator['first_name']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name"
                                                    placeholder="Enter last name"
                                                    value="<?= $coordinator['last_name']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="coordinator_contact_number">Contact Number</label>
                                                <input type="text" class="form-control" id="coordinator_contact_number"
                                                    name="coordinator_contact_number"
                                                    placeholder="Enter coordinator Contact Number"
                                                    value="<?= $coordinator['contact_number']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="organization_id">Organization</label>
                                                <select class="form-control" id="organization_id" name="organization_id"
                                                    required>
                                                    <?php foreach ($organizations as $organization) : ?>
                                                    <option value="<?= $organization['organization_id']; ?>"
                                                        <?= $organization['organization_id'] == $coordinator['organization_id'] ? 'selected' : ''; ?>>
                                                        <?= $organization['organization_name']; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="coordinator_email">Email</label>
                                                <input type="email" class="form-control" id="coordinator_email"
                                                    name="coordinator_email" placeholder="Enter coordinator Email"
                                                    value="<?= $coordinator['user_email']; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                    <button type="submit" name="edit_coordinator" class="btn btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end edit coordinator modal -->

                <!-- delete coordinator modal -->
                <div class="modal fade" id="deletecoordinatorModal" data-backdrop="static" tabindex="-1" role="dialog"
                    aria-labelledby="deletecoordinatorModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form method="POST" action="coordinator_delete.php">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deletecoordinatorModalLabel">
                                        <?= $coordinator['first_name'] . ' ' . $coordinator['last_name']; ?>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this coordinator?
                                    <input type="hidden" name="coordinator_id"
                                        value="<?= $coordinator['coordinator_id']; ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger"
                                        name="coordinator_delete">Delete</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end delete coordinator modal -->

    </main>

    <?php require_once('components/footer.php'); ?>