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
                        <span>
                            <?= $coordinator['organization_name']; ?>
                        </span>
                    </h1>

                    <a class="btn btn-white float-right" href="javascript:void(0);" data-toggle="modal"
                        data-target="#createTaskModal">
                        <span class="icon text-primary-600 mr-2">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">
                            Create Task
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <!--Table-->
        <div class="container-fluid mt-n10">
            <?php require_once('components/alert.php'); ?>

            <!--Card Primary-->
            <div class="row">

                <div class="col-md-6">
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

                <div class="col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <p>
                                Coordinator Tasks
                            </p>
                            <p>
                                <?=count($coordinator_tasks); ?>
                            </p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#dataTable">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    Coordinator Tasks (<?= count($coordinator_tasks); ?>)
                </div>
                <div class="card-body">
                    <?php if(count($coordinator_tasks) > 0) : ?>
                    <div class="datatable table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Created By</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($coordinator_tasks as $task) : ?>
                                <tr>
                                    <td><?= $task['task_name']; ?></td>
                                    <td><?= $task['task_description']; ?></td>
                                    </td>
                                    <td><?= $task['first_name'] . ' ' . $task['last_name']; ?>
                                    </td>
                                    <td>
                                        <a href="task.php?task_id=<?= $task['task_id']; ?>"
                                            class="btn btn-sm btn-primary">
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
                        No tasks found.
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- create task modal -->
            <div class="modal fade" id="createTaskModal" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="createTaskModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <form method="POST" action="task_create.php">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createTaskModalLabel">Create task</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="coordinator_id" value="<?= $coordinator['coordinator_id']; ?>">
                                <input type="hidden" name="organization_id"
                                    value="<?=$coordinator['organization_id']; ?>">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="task_name">Name</label>
                                            <input type="text" class="form-control" id="task_name" name="task_name"
                                                placeholder="Enter task Name" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="task_description">Description</label>
                                            <textarea class="form-control" id="task_description" rows="3"
                                                name="task_description" placeholder="Enter task Description"
                                                required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" name="create_task" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end create task modal -->


    </main>

    <?php require_once('components/footer.php'); ?>