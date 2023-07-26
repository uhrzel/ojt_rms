<?php
require_once('init.php');

$title = 'Courses';
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
                            <?= $title; ?> <span class="badge badge-white ml-2"><?=count($courses); ?></span>
                        </span>
                    </h1>

                    <div class="float-right">
                        <a class="btn btn-dark btn-icon-split ml-2" href="index.php">
                            <span class="icon text-white-600">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                        </a>

                        <a class="btn btn-white btn-icon-split ml-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#createcourseModal">
                            <span class="icon text-white-600 mr-1">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">New</span>
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
                    Course List
                </div>
                <div class="card-body">
                    <?php if(count($courses) > 0): ?>
                    <div class="datatable table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($courses as $course): ?>
                                <tr>
                                    <td><?=$course['course_code']; ?></td>
                                    <td><?=$course['course_name']; ?></td>
                                    <td>
                                        <a href="course.php?course_id=<?=$course['course_id']; ?>"
                                            class="btn btn-primary btn-icon-split btn-sm" title="View">
                                            <span class="icon text-white-600">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No courses found.
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!--End Table-->

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