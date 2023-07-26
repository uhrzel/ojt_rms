<?php
require_once('init.php');

$title = 'Coordinators';
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
                        <div class="page-header-icon"><i data-feather="user-check"></i></div>
                        <span>
                            <?= $title; ?><span class="badge badge-white ml-2"><?=count($coordinators); ?></span>
                        </span>
                    </h1>

                    <div class="float-right">
                        <a class="btn btn-dark btn-icon-split ml-2" href="index.php">
                            <span class="icon text-white-600">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                        </a>

                        <a class="btn btn-white btn-icon-split ml-2" href="javascript:void(0);" data-toggle="modal"
                            data-target="#createcoordinatorModal">
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
                    Coordinators List
                </div>
                <div class="card-body">
                    <?php if(count($coordinators) > 0): ?>
                    <div class="datatable table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Organization</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($coordinators as $coordinator): ?>
                                <tr>
                                    <td>
                                        <?=$coordinator['first_name'] . ' ' . $coordinator['last_name']; ?>
                                    </td>
                                    <td>
                                        <?=$coordinator['user_email']; ?>
                                    </td>
                                    <td>
                                        <?=$coordinator['contact_number']; ?>
                                    </td>
                                    <td>
                                        <?=$coordinator['organization_name']; ?>
                                    </td>
                                    <td>
                                        <?php if($coordinator['isVerified'] == 1): ?>
                                        <span class="badge badge-success">
                                            Verified
                                        </span>
                                        <?php else: ?>
                                        <span class="badge badge-danger">
                                            Not Verified
                                        </span>
                                        <?php endif; ?>

                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle text-white"
                                            id="coordinator_verify_option" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                                            aria-labelledby="coordinator_verify_option">

                                            <?php if($coordinator['isVerified'] == 1): ?>

                                            <li>

                                                <a href="coordinator_unverify.php?coordinator_id=<?=$coordinator['coordinator_id']; ?>"
                                                    class="btn btn-sm" title="Unverify">
                                                    <i class="fas fa-times"></i> Unverify
                                                </a>
                                                
                                            </li>

                                            <?php else: ?>

                                            <li>
                                                
                                                <a href="coordinator_verify.php?coordinator_id=<?=$coordinator['coordinator_id']; ?>"
                                                    class="btn btn-sm" title="Verify">
                                                    <i class="fas fa-check"></i> Verify
                                                </a>

                                            </li>

                                            <?php endif; ?>

                                        </ul>

                                    </td>
                                    <td>
                                        <a href="coordinator.php?coordinator_id=<?=$coordinator['coordinator_id']; ?>"
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
                        <i class="fas fa-info-circle"></i> No coordinators found.
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!--End Table-->

        <!-- create coordinator Modal-->
        <div class="modal fade" id="createcoordinatorModal" tabindex="-1" role="dialog"
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

    </main>

    <?php require_once('components/footer.php'); ?>