<?php
require_once('init.php');

$title = 'Task Details';
$curr_page = basename(__FILE__);

if(!isset($_GET['task_id'])) {
    header('Location: tasks.php');
}

$task_id = $_GET['task_id'];

$task = $get_task->getStudentTask($task_id);

?>

<?php require_once('components/header.php'); ?>
<?php require_once('components/sidebar.php'); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="page-header pb-10 page-header-dark bg-gradient-primary-to-secondary">
            <div class="container-fluid">
                <div class="page-header-content">
                    <h1 class="page-header-title d-inline-block">
                        <div class="page-header-icon"><i data-feather="list"></i></div>
                        <span>
                            <?= $title; ?>
                        </span>
                    </h1>

                    <div class="float-right">
                        <a class="btn btn-dark mr-2" href="tasks.php">
                            <i class="fas fa-arrow-left"></i>
                        </a>

                        <a class="btn btn-danger mr-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#deleteTaskModal">
                            <i class="fas fa-trash"></i>
                        </a>

                        <a class="btn btn-white mr-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#editTaskModal">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!--Table-->
        <div class="container-fluid mt-n10">
            <?php require_once('components/alert.php'); ?>

            <div class="card mb-4">
                <div class="card-body">
                <div class="row">
                        <div class="col-md-6">
                            <h5>Task Details</h5>
                            <hr>
                            <p><strong>Task Name:</strong> <?= $task['task_name']; ?></p>
                            <p><strong>Task Description:</strong> <?= $task['task_description']; ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Created by</h5>
                            <hr>
                            <p><strong>Name:</strong> 
                            <?= $task['first_name'] . ' ' . $task['last_name']; ?>
                            </p>
                            <p><strong>Role:</strong> OJT Student</p>
                            <p><strong>Date Created:</strong> <?= date('l, F d, Y', strtotime($task['task_created'])); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Table-->

        <!-- edit task modal -->
        <div class="modal fade" id="editTaskModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="editTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" action="task_edit.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTaskModalLabel">Create task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="task_id" value="<?= $task['task_id']; ?>">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="task_name">Name</label>
                                        <input type="text" class="form-control" id="task_name"
                                            name="task_name" placeholder="Enter task Name" value="<?= $task['task_name']; ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="task_description">Description</label>
                                        <textarea class="form-control" id="task_description" rows="3"
                                            name="task_description" placeholder="Enter task Description"
                                            required><?= $task['task_description']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" name="create_task" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end edit task modal -->

        <!-- delete task modal -->
        <div class="modal fade" id="deleteTaskModal" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="deleteTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="task_delete.php">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteTaskModalLabel">Delete task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="task_id" value="<?= $task['task_id']; ?>">
                            <p>Are you sure you want to delete this task?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="delete_task" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end delete task modal -->

    </main>

    <?php require_once('components/footer.php'); ?>